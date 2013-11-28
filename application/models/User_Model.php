<?php
/**
 * Class User_Model
 */
class User_Model extends CI_Model
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $ID
     * @return User
     */
    public static function getUserByID($ID)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->select('user.*');
        $CI->db->from('user');
        $CI->db->where('user.id', $ID);

        $query = $CI->db->get();
        $row   = $query->row();
        if ($row) {
            $thatUser = new User(
                $row->ID,
                $row->Username,
                $row->Nickname,
                $row->PasswordHashed,
                $row->Salt,
                $row->GroupID,
                $row->LastActivityIP,
                $row->LastActivityTime,
                $row->LastLoginIP,
                $row->LastLoginTime
            );
            return $thatUser;
        }

        return null;
    }

    /**
     * @param string $Username
     * @return User
     */
    public static function getUserByUsername($Username)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->select('user.*');
        $CI->db->from('user');
        $CI->db->where('user.Username', $Username);

        $query = $CI->db->get();
        $row   = $query->row();
        if ($row) {
            $thatUser = new User(
                $row->ID,
                $row->Username,
                $row->Nickname,
                $row->PasswordHashed,
                $row->Salt,
                $row->GroupID,
                $row->LastActivityIP,
                $row->LastActivityTime,
                $row->LastLoginIP,
                $row->LastLoginTime
            );
            return $thatUser;
        }

        return null;
    }


    /**
     * @return UserList
     */
    public static function getUserList()
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('user.*');
        $CI->db->from('user');

        $query  = $CI->db->get();
        $result = $query->result();

        $thisUserList = new UserList();

        foreach ($result as $row) {
            $thatUser = new User(
                $row->ID,
                $row->Username,
                $row->Nickname,
                $row->PasswordHashed,
                $row->Salt,
                $row->GroupID,
                $row->LastActivityIP,
                $row->LastActivityTime,
                $row->LastLoginIP,
                $row->LastLoginTime
            );

            $thisUserList->addUser($thatUser);
        }
        return $thisUserList;
    }


    /**
     * @param int $ID
     * @return UserList
     */
    public static function getUserListByGroupID($ID)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('user.*');
        $CI->db->from('user');
        $CI->db->where('user.GroupID', $ID);

        $query  = $CI->db->get();
        $result = $query->result();

        $thisUserList = new UserList();

        foreach ($result as $row) {
            $thatUser = new User(
                $row->ID,
                $row->Username,
                $row->Nickname,
                $row->PasswordHashed,
                $row->Salt,
                $row->GroupID,
                $row->LastActivityIP,
                $row->LastActivityTime,
                $row->LastLoginIP,
                $row->LastLoginTime
            );

            $thisUserList->addUser($thatUser);
        }
        return $thisUserList;
    }

    /**
     * @param array $UserIDArray
     * @return UserList
     */
    public static function getUserListByUserIDArray($UserIDArray)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('user.*');
        $CI->db->from('user');
        $CI->db->where('user.ID');
        foreach ($UserIDArray as $thisUserID) {
            $CI->db->or_where('user.ID', $thisUserID);
        }
        $query  = $CI->db->get();
        $result = $query->result();

        $thisUserList = new UserList();

        foreach ($result as $row) {
            $thatUser = new User(
                $row->ID,
                $row->Username,
                $row->Nickname,
                $row->PasswordHashed,
                $row->Salt,
                $row->GroupID,
                $row->LastActivityIP,
                $row->LastActivityTime,
                $row->LastLoginIP,
                $row->LastLoginTime
            );

            $thisUserList->addUser($thatUser);
        }
        return $thisUserList;
    }

    /**
     * @param int $Page
     * @param int $Limit
     * @return UserList
     */
    public static function getUserListByPageAndLimit($Page, $Limit)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('user.*');
        $CI->db->from('user');
        $CI->db->limit($Limit, ($Page - 1) * $Limit);

        $query  = $CI->db->get();
        $result = $query->result();

        $thisUserList = new UserList();

        foreach ($result as $row) {
            $thatUser = new User(
                $row->ID,
                $row->Username,
                $row->Nickname,
                $row->PasswordHashed,
                $row->Salt,
                $row->GroupID,
                $row->LastActivityIP,
                $row->LastActivityTime,
                $row->LastLoginIP,
                $row->LastLoginTime
            );

            $thisUserList->addUser($thatUser);
        }
        return $thisUserList;
    }

    /**
     * @param User $thatUser
     * @return User
     */
    public static function addUser($thatUser)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $insertResult = $CI->db->insert('user', array(
            'Username'         => $thatUser->getUsername(),
            'Nickname'         => $thatUser->getNickname(),
            'PasswordHashed'   => $thatUser->getPasswordHashed(),
            'Salt'             => $thatUser->getSalt(),
            'GroupID'          => $thatUser->getGroupID(),
            'LastActivityIP'   => $thatUser->getLastActivityIP(),
            'LastActivityTime' => $thatUser->getLastActivityTime(),
            'LastLoginIP'      => $thatUser->getLastLoginIP(),
            'LastLoginTime'    => $thatUser->getLastLoginTime()
        ));
        if ($insertResult)
            return self::getUserByID($CI->db->insert_id());
        else
            return null;
    }

    /**
     * @param User $thatUser
     * @return User
     */
    public static function updateUser($thatUser)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->where('ID', $thatUser->getID());
        $updateResult = $CI->db->update('user', array(
            'Username'         => $thatUser->getUsername(),
            'Nickname'         => $thatUser->getNickname(),
            'PasswordHashed'   => $thatUser->getPasswordHashed(),
            'GroupID'          => $thatUser->getGroupID(),
            'LastActivityIP'   => $thatUser->getLastActivityIP(),
            'LastActivityTime' => $thatUser->getLastActivityTime(),
            'LastLoginIP'      => $thatUser->getLastLoginIP(),
            'LastLoginTime'    => $thatUser->getLastLoginTime()
        ));
        if ($updateResult)
            return self::getUserByID($thatUser->getID());
        else
            return null;
    }

    /**
     * @param User $thatUser
     * @return bool
     */
    public static function deleteUser($thatUser)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->where('ID', $thatUser->getID());
        $deleteResult = $CI->db->delete('user');
        if ($deleteResult)
            return true;
        else
            return false;
    }

    /**
     * @param Integer $ID
     * @return bool
     */
    public static function IsIDExist($ID)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->select('user.ID');
        $CI->db->from('user');
        $CI->db->where('user.ID', $ID);
        $query = $CI->db->get();
        if ($query->num_rows() !== 0)
            return true;
        else
            return false;
    }

    /**
     * @param String $Username
     * @return bool
     */
    public static function IsUsernameExist($Username)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->select('user.Username');
        $CI->db->from('user');
        $CI->db->where('user.Username', $Username);
        $query = $CI->db->get();
        if ($query->num_rows() !== 0)
            return true;
        else
            return false;
    }

}
