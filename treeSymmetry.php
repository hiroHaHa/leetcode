<?php
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     public function __construct($value) { $this->val = $value; }
 * }
 */

/*
给定一个二叉树，检查它是否是镜像对称的。
例如，二叉树 [1,2,2,3,4,4,3] 是对称的。

    1
   / \
  2   2
 / \ / \
3  4 4  3

但是下面这个 [1,2,2,null,3,null,3] 则不是镜像对称的:

    1
   / \
  2   2
   \   \
   3    3

思路：如果一棵树的左子树与右子树镜像对称，那么这个树是对称的。

根左右 == 根右左，表示是对称的，即左前序遍历与右前序遍历相等。
*/

class Tree
{
	// 迭代解法，time:O(n),space:O(n)
	// 引入一个辅助栈或者辅助队列
	public function isSymmetric1($root)
	{
		if ($root == null || ($root->left == null && $root->right == null)) {
			return true;
		}
		return $this->_checkIter($root,$root);
	}

	private function _checkIter($root1,$root2)
	{
		$queue = [];
		
		array_push($queue,$root1,$root2);

		while (!empty($queue)) {
			$root1 = array_shift($queue);
			$root2 = array_shift($queue);

			if ($root1 == null && $root2 == null) {
				continue;
			}

			if ($root1 == null || $root2 == nul) {
				return false;
			}

			if ($root1->val != $root2->val) {
				return false;
			}

			array_push($queue,$root1->left,$root2->right);
			array_push($queue,$root1->right,$root2->left);
		}

		return true;
	}

	// 递归解法，time:O(n),space:O(n)
	public function isSymmetric2($root)
	{
		if ($root == null || ($root->left == null && $root->right == null)) {
			return true;
		}
		return $this->_checkRecur($root,$root);
	}

	private function _checkRecur($root1,$root2)
	{
		if ($root1 == null && $root2 == null) {
			return true;
		}

		if ($root1 == null || $root2 == null) {
			return false;
		}

		if ($root1->val != $root2->val) {
			return false;
		}

		return $this->_checkRecur($root1->left,$root2->right) && $this->_checkRecur($root1->right,$root2->left);
	}
}