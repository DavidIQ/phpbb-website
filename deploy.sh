set -ex
git fetch private
git checkout www1-stable
git reset --hard private/www1-stable
git merge --no-ff private
git push private www1-stable
