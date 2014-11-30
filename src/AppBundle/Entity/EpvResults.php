<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EpvResults
 */
class EpvResults
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $github;

	/**
	 * @var integer
	 */
	private $runtime;


	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set github
	 *
	 * @param string $github
	 * @return EpvResults
	 */
	public function setGithub($github)
	{
		$this->github = $github;

		return $this;
	}

	/**
	 * Get github
	 *
	 * @return string
	 */
	public function getGithub()
	{
		return $this->github;
	}

	/**
	 * Set runtime
	 *
	 * @param integer $runtime
	 * @return EpvResults
	 */
	public function setRuntime($runtime)
	{
		$this->runtime = $runtime;

		return $this;
	}

	/**
	 * Get runtime
	 *
	 * @return integer
	 */
	public function getRuntime()
	{
		return $this->runtime;
	}
}
