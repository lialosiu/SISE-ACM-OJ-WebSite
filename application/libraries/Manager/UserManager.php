<?php

/**
 * Class UserManager
 */
class UserManager
{
    /**
     * @param string $Username
     * @param string $Password
     * @return \User
     * @throws Exception
     */
    public static function register($Username, $Password)
    {
        /** @var $CI CI */
        $CI =& get_instance();
        $CI->load->library('session');

        if ($CI->session->userdata('LastRegisterTime') && (time() - $CI->session->userdata('LastRegisterTime')) / 60 < 15) {
            throw new Exception("15分钟内不能多次注册");
        }

        //判断用户名是否存在
        if (self::IsUsernameExist($Username)) {
            //用户名已存在
            throw new Exception("用户名已被使用");
        }

        $salt = sprintf('%05d', rand(0, 99999));

        $thatUser = new User(
            0,
            $Username,
            $Username,
            do_hash(do_hash($Password) . $salt),
            $salt,
            0
        );

        //储存用户ID信息至Session
        $CI->session->set_userdata('LastRegisterTime', time());

        //新建用户
        $thatUser = User_Model::addUser($thatUser);

        //检查注册结果
        if ($thatUser) {
            return $thatUser;
        } else {
            throw new Exception("数据库查询失败");
        }
    }

    /**
     * @param string $Username
     * @param string $Nickname
     * @param string $Password
     * @param int $GroupID
     * @throws Exception
     * @return \User
     */
    public static function addUser($Username, $Nickname, $Password, $GroupID)
    {
        //判断用户名是否存在
        if (self::IsUsernameExist($Username)) {
            //用户名已存在
            throw new Exception("用户名已被使用");
        }

        $salt = sprintf('%05d', rand(0, 99999));

        $thatUser = new User(
            0,
            $Username,
            $Nickname,
            do_hash(do_hash($Password) . $salt),
            $salt,
            $GroupID
        );

        //新建用户
        $thatUser = User_Model::addUser($thatUser);

        //检查注册结果
        if ($thatUser) {
            return $thatUser;
        } else {
            throw new Exception("数据库查询失败");
        }
    }

    /**
     * @param String $Username
     * @param String $Password
     * @return User
     * @throws Exception
     */
    public static function login($Username, $Password)
    {
        /** @var $CI CI */
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->library('input');

        //判断用户名是否存在
        if (!self::IsUsernameExist($Username)) {
            throw new Exception("用户名不存在");
        }

        //通过用户名获取用户
        $thatUser = UserManager::getUserByUsername($Username);

        //检查密码是否正确
        if ($thatUser->getPasswordHashed() === do_hash(do_hash($Password) . $thatUser->getSalt())) {
            //密码正确

            //更新用户信息
            $thatUser->setLastLoginIP($CI->input->ip_address());
            $thatUser->setLastLoginTime(date("Y-m-d H:i:s", time()));
            $thatUser->setLastActivityIP($thatUser->getLastLoginIP());
            $thatUser->setLastActivityTime($thatUser->getLastActivityTime());

            //更新数据库
            User_Model::updateUser($thatUser);

            //储存用户ID信息至Session
            $CI->session->set_userdata('UserID', $thatUser->getID());

            //正常返回
            return $thatUser;

        } else {
            throw new Exception("密码不正确");
        }
    }

    public static function logout()
    {
        /** @var $CI CI */
        $CI =& get_instance();
        $CI->load->library('session');

        $CI->session->unset_userdata('UserID');
    }

    /**
     * @param User $thatUser
     * @return bool
     * @throws Exception
     */
    public static function deleteUser($thatUser)
    {
        //删除用户
        $deleteUserResult = User_Model::deleteUser($thatUser);

        //检查结果
        if ($deleteUserResult === true) {
            return true;
        } else {
            //数据库查询失败
            throw new Exception("数据库查询失败");
        }
    }

    /**
     * @param User $thatUser
     * @param String $NewUsername
     * @return User $thatUser
     * @throws Exception
     */
    public static function changeUsername($thatUser, $NewUsername)
    {
        //判断用户名是否存在
        if (self::IsUsernameExist($NewUsername)) {
            //用户名已存在
            throw new Exception("用户名已被使用");
        }

        $thatUser->setUsername($NewUsername);

        $updateResult = User_Model::updateUser($thatUser);

        //检查修改结果
        if ($updateResult === true) {
            return $thatUser;
        } else {
            //数据库查询失败
            throw new Exception("数据库查询失败");
        }
    }

    /**
     * @param User $thatUser
     * @param String $NewPassword
     * @return User $thatUser
     * @throws Exception
     */
    public static function changePassword($thatUser, $NewPassword)
    {
        $thatUser->setPasswordHashed(do_hash(do_hash($NewPassword) . $thatUser->getSalt()));

        $updateResult = User_Model::updateUser($thatUser);

        //检查修改结果
        if ($updateResult === true) {
            return $thatUser;
        } else {
            //数据库查询失败
            throw new Exception("数据库查询失败");
        }
    }

    public static function getCurrentUserBySession()
    {
        /** @var $CI CI */
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->library('input');

        //检查Session中的Token信息
        if ($CI->session->userdata('UserID') !== false) {
            //Token合法

            //获取用户信息
            $thatUser = UserManager::getUserByID($CI->session->userdata('UserID'));

            //检查是否获取成功
            if (!$thatUser || $thatUser->getID() === 0) {
                throw new Exception('UserID无效');
            }

            //更新用户活动时间
            $thatUser->setLastActivityIP($CI->input->ip_address());
            $thatUser->setLastActivityTime(date("Y-m-d H:i:s", time()));

            //更新数据库
            User_Model::updateUser($thatUser);

            return $thatUser;
        }
        return new User();
    }

    /**
     * @param Integer $ID
     * @return User
     */
    public static function getUserByID($ID)
    {
        switch ($ID) {
            case 0:
                return new User(0, 'Guest', '游客');
            default:
                return User_Model::getUserByID($ID);
        }
    }

    /**
     * @param String $Username
     * @return User
     */
    public static function getUserByUsername($Username)
    {
        $thatUser = User_Model::getUserByUsername($Username);

        if ($thatUser)
            return $thatUser;
        else
            return new User(0, '#NULL#', '#用户不存在#');
    }


    /**
     * @return UserList
     */
    public static function getUserList()
    {
        return User_Model::getUserList();
    }

    /**
     * @param int $ID
     * @return UserList
     */
    public static function getUserListByGroupID($ID)
    {
        return User_Model::getUserListByGroupID($ID);
    }

    /**
     * @param $UserIDArray
     * @return UserList
     */
    public static function getUserListByUserIDArray($UserIDArray)
    {
        return User_Model::getUserListByUserIDArray($UserIDArray);
    }

    /**
     * @param Integer $Page
     * @param Integer $Limit
     * @return UserList
     */
    public static function getUserListByPageAndLimit($Page, $Limit)
    {
        return User_Model::getUserListByPageAndLimit($Page, $Limit);
    }

    /**
     * @param String $Username
     * @return bool
     */
    public static function IsUsernameExist($Username)
    {
        if (User_Model::IsUsernameExist($Username)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param User $thatUser
     * @return User
     */
    public static function updateUser($thatUser)
    {
        return User_Model::updateUser($thatUser);
    }

}