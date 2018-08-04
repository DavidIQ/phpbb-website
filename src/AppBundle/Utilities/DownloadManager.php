<?php
/**
 *
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace AppBundle\Utilities;

use Symfony\Component\HttpKernel\Config\FileLocator;

class DownloadManager
{
	protected $branch;
	protected $selectedVersion;
	protected $update;
	protected $packages;
	protected $fromVersions;
	protected $kernel;
	protected $cache;

	public function __construct($cache, $kernel)
	{
		$this->cache = $cache;
		$this->kernel = $kernel;
	}

	public function setBranch($branch)
	{
		$this->branch = $branch;

		return;
	}

	public function setUpdate($selectedVersion)
	{
		$this->selectedVersion = $selectedVersion;
		$this->update = true;

		return;
	}

	public function getAvailableUpdateFromVersions()
	{
		return $this->fromVersions;
	}

	public function generatePackages()
	{
		$this->generatePackageList();

		return array(
			'packages' => $this->packages,
			'caching' => $this->caching,
			'updateFromVersions' => $this->fromVersions,
		);
	}

	private function getPackagesJsonData()
	{
		if ($this->cache->contains('packages_json_downloads') !== FALSE)
		{
			// If we have it in cache, get the packages.json file
			$packagesDataJson 	= $this->cache->fetch('packages_json_downloads');
			$cacheStatus 		= 'Hit';
		}
		else
		{
			// If we don't have it in cache, find it & load it
			$locator = new FileLocator($this->kernel->getRootDir());
			$locator->locate('packages.json', null, true);
			$packagesDataJson = $locator->getContents();
			$this->cache->save('packages_json_downloads', $packagesDataJson, 86400);
			$cacheStatus = 'Miss';
		}

		// Parse JSON response and discard irrelevant branches
		return json_decode($packagesDataJson, true);
	}

	private function generatePackageList()
	{
		// Get packages
		$packagesData 		= $this->getPackagesJsonData();

		// Discard those not on this branch
		$relevantPackages 	= $packagesData[$this->branch];

		// Latest release in this branch is...
		$release = $relevantPackages['release'];

		// Generate from versions
		$this->fromVersions = explode(',', $relevantPackages['updates']['from']);

		// Check selected version is a valid version
		if (!in_array($this->selectedVersion, $this->fromVersions))
		{
			$update = false;
		}

		// Link to the packages for this release. Add filenames on here for download urls.
		$download_base_link = 'https://download.phpbb.com/pub/release/' . $this->branch . '/' . $release . '/';

		$hashCaches = 0;
		$packagesTotal = 0;

		// If we haven't established it's an update (and have an update from version)
		if (!$this->update)
		{
			// Discard irrlevant data
			$packages = array(
				'package' 		=> $relevantPackages['package']['release'],
				'patch' 		=> $relevantPackages['updates']['patch'],
				'changed-files' => $relevantPackages['updates']['changed-files'],
			);

			foreach ($packages as $package)
			{
				// URL to this specific package
				$url = $download_base_link . $package['filename'];

				// Generate sha256/md5 hashes for packages
				$hash = $this->gethash($packages[$package]['filename'], $url);

				// Make use of the stuff we just generated by putting it back in ready for templates
				$packages[$package]['url'] 		= $url;
				$packages[$package]['hash'] 	= $hash['hash'];
				$packages[$package]['hashType'] = $hash['hashType'];

				// Counts
				$packagesTotal++;
				($hash['hashCacheStatus'] == 'Hit') ? $hashCaches++ : null;
			}
		}
		else
		{
			// Discard irrlevant data
			$packages = array(
				'package' 		=> $relevantPackages['package']['release'],
			);

			foreach ($relevantPackages['updates']['changed-files'] as $changedFilesPackage)
			{
				if ($changedFilesPackage['from'] == $this->selectedVersion)
				{
					// URL to this specific package
					$url = $download_base_link . $changedFilesPackage['filename'];

					// Generate sha256/md5 hashes for packages
					$hash = $this->gethash($changedFilesPackage['filename'], $url);

					// Make use of the stuff we just generated by putting it back in ready for templates
					$changedFilesPackage['url'] 		= $url;
					$changedFilesPackage['hash'] 		= $hash['hash'];
					$changedFilesPackage['hashType'] 	= $hash['hashType'];

					// Counts
					$packagesTotal++;
					($hash['hashCacheStatus'] == 'Hit') ? $hashCaches++ : null;

					$packages['changed_files'] = $changedFilesPackage;
				}
			}

			foreach ($relevantPackages['updates']['patch'] as $patchFilesPackage)
			{
				if ($patchFilesPackage['from'] == $this->selectedVersion)
				{
					// URL to this specific package
					$url = $download_base_link . $patchFilesPackage['filename'];

					// Generate sha256/md5 hashes for packages
					$hash = $this->gethash($patchFilesPackage['filename'], $url);

					// Make use of the stuff we just generated by putting it back in ready for templates
					$patchFilesPackage['url'] 		= $url;
					$patchFilesPackage['hash'] 		= $hash['hash'];
					$patchFilesPackage['hashType'] 	= $hash['hashType'];

					// Counts
					$packagesTotal++;
					($hash['hashCacheStatus'] == 'Hit') ? $hashCaches++ : null;

					$packages['patch'] = $patchFilesPackage;
				}
			}

			foreach ($relevantPackages['updates']['code-changes'] as $ccFilesPackage)
			{
				if ($ccFilesPackage['from'] == $this->selectedVersion)
				{
					// URL to this specific package
					$url = $download_base_link . $ccFilesPackage['filename'];

					// Generate sha256/md5 hashes for packages
					$hash = $this->gethash($ccFilesPackage['filename'], $url);

					// Make use of the stuff we just generated by putting it back in ready for templates
					$ccFilesPackage['url'] 		= $url;
					$ccFilesPackage['hash'] 	= $hash['hash'];
					$ccFilesPackage['hashType']	= $hash['hashType'];

					// Counts
					$packagesTotal++;
					($hash['hashCacheStatus'] == 'Hit') ? $hashCaches++ : null;

					$packages['code-changes'] = $ccFilesPackage;
				}
			}

			foreach ($relevantPackages['updates']['automatic-updaters'] as $automaticFilesPackage)
			{
				if ($automaticFilesPackage['from'] == $this->selectedVersion)
				{
					// URL to this specific package
					$url = $download_base_link . $automaticFilesPackage['filename'];

					// Generate sha256/md5 hashes for packages
					$hash = $this->gethash($automaticFilesPackage['filename'], $url);

					// Make use of the stuff we just generated by putting it back in ready for templates
					$automaticFilesPackage['url'] 		= $url;
					$automaticFilesPackage['hash'] 		= $hash['hash'];
					$automaticFilesPackage['hashType'] 	= $hash['hashType'];

					// Counts
					$packagesTotal++;
					($hash['hashCacheStatus'] == 'Hit') ? $hashCaches++ : null;

					$packages['automatic-updater'] = $automaticFilesPackage;
				}
			}
		}

		$this->packages = $packages;
		$this->caching = array($cacheStatus, $hashCaches, $packagesTotal);

		return;
	}

	/**
	 * Get the MD5 or SHA256 hash
	 *
	 * @param  string $packageName  Package Filename
	 * @param  string $url		  Url to the package
	 * @return array 				hash, hashType (md5 or sha356), hashCacheStatus (Hit or Miss)
	 */
	private function getHash($packageName, $url)
	{
		$cacheName = 'packages_hash' . $packageName;
		$hashType = ($this->branch == '3.0') ? 'md5' : 'sha256';

		if ($this->cache->contains($cacheName) !== FALSE)
		{
			// See if we've cached the hash before grabbing an external file
			$hash = $this->cache->fetch($cacheName);
			$hashCacheStatus = 'Hit';
		}
		else
		{
			// It seems we have no choice, grab the file from the external server
			$hash = @file_get_contents($url . '.' . $hashType);
			$this->cache->save($cacheName, $hash, 86400);
			$hashCacheStatus = 'Miss';
		}

		return array(
			'hash' 				=> $hash,
			'hashType' 			=> $hashType,
			'hashCacheStatus' 	=> $hashCacheStatus
		);
	}
}
