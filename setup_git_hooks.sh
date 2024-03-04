set -e

echo "Installing git hooks"

ln -sf "$(pwd)/.git_hooks/post-checkout_hook" ./.git/hooks/post-checkout
ln -sf "$(pwd)/.git_hooks/post-merge_hook" ./.git/hooks/post-merge
ln -sf "$(pwd)/.git_hooks/pre-commit_hook" ./.git/hooks/pre-commit
ln -sf "$(pwd)/.git_hooks/pre-push_hook" ./.git/hooks/pre-push

echo "Success"