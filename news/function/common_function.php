<?php
/**
 * Common_function 通用功能
 * @author Hao-Yuang Li
 * @version 1.02
 */
@session_start();
require_once('db_connect.php');
class Common_function extends Db_connect {
    public $sql;
    public $data_array; //存放資料陣列
    public $result_array; //存放處理過的資料陣列
    public $data_nums; //資料總比數
    public $per = 5; //每頁幾筆資料
    public $page; //目前頁碼
    public $pages; //總頁數

    function __construct()
    {
        parent::set_database('localhost', 'root', 'stust', 'my_db');
    }

    //取得發佈的文章
    public function get_publish_article()
    {
        $sql = "SELECT COUNT(*) FROM `article` WHERE `publish` = 1";
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $this->data_nums = $query->fetchColumn(); //取得資料總比數
        $this->pages = ceil($this->data_nums / $this->per); //計算總頁數
        if ( ! isset($_GET['page']))
        {
            $page = 1;
        }
        else
        {
            $page = intval($_GET['page']);
        }
        $start = ($page - 1) * $this->per; //每一頁開始的資料序號
        $sql = "SELECT `id`, `title`, `category`, `content`, `create_datetime`, `modify_datetime`, `edit_count`
                FROM `article`
                WHERE `publish` = 1 LIMIT :start, :per";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':start', $start, PDO::PARAM_INT);
        $query->bindValue(':per', $this->per, PDO::PARAM_INT);
        $start = 2;
        $query->execute();
        if ($query->rowCount() > 0)
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }

    //取得搜尋到的文章,$keyword為搜尋關鍵字
    public function get_search_article($keyword)
    {
        $keyword = "%".$keyword."%";
        $sql = "SELECT COUNT(*) FROM `article` WHERE `title` LIKE :keyword1 OR `content` LIKE :keyword2";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':keyword1', $keyword, PDO::PARAM_STR);
        $query->bindValue(':keyword2', $keyword, PDO::PARAM_STR);
        $query->execute();
        $this->data_nums = $query->fetchColumn(); //取得資料總比數
        $this->pages = ceil($this->data_nums / $this->per); //計算總頁數
        if ( ! isset($_GET['page']))
        {
            $page = 1;
        }
        else
        {
            $page = intval($_GET['page']);
        }
        $start = ($page - 1) * $this->per; //每一頁開始的資料序號
        $sql = "SELECT `id`, `title`, `category`, `content`, `create_datetime`, `modify_datetime`, `edit_count`
                FROM `article`
                WHERE `title` LIKE :keyword1 OR `content` LIKE :keyword2 LIMIT :start, :per";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':keyword1', $keyword, PDO::PARAM_STR);
        $query->bindValue(':keyword2', $keyword, PDO::PARAM_STR);
        $query->bindValue(':start', $start, PDO::PARAM_INT);
        $query->bindValue(':per', $this->per, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0)
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }

    //取得發佈的作品
    public function get_publish_work()
    {
        $sql = "SELECT `id`, `title`, `intro`, `video_path`, `youtube_link` FROM `work` WHERE `publish`= 1" ;
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $data_array = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($query->rowCount() > 0)
        {
            $this->data_nums = $query->rowCount();
            return $data_array;
        }
        else
        {
            return FASLE;
        }
    }

    //取得指定文章的留言,$article_id為文章id
    public function get_designated_article_comment($article_id)
    {
        $sql = "SELECT `id`,
                       `content`,
                       `create_datetime`,
                       `modify_datetime`,
                       `create_user_id`,
                       `edit_count`,
                       (SELECT `nickname` FROM `user` WHERE `user`.`id` = `comment`.`create_user_id`) AS create_user_nickname
                FROM `comment`
                WHERE `article_id` = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':id', $article_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0)
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }

    //取得指定的已發布文章,$article_id為文章id
    public function get_designated_publish_article($article_id)
    {
        $sql= "SELECT `title`,
                      `category`,
                      `content`,
                      `create_datetime`,
                      `modify_datetime`,
                      `edit_count`
                FROM `article`
                WHERE `publish` = 1 AND `id` = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':id', $article_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return $query->fetch(PDO::FETCH_ASSOC);;
        }
        else
        {
            return FALSE;
        }
    }

    //取得指定的已發布作品,$work_id為作品id
    public function get_designated_publish_work($work_id)
    {
        $sql = "SELECT `title`,
                       `intro`,
                       `video_path`,
                       `youtube_link`,
                       `create_datetime`,
                       `modify_datetime`,
                       `edit_count`
                FROM `work`
                WHERE `publish`= 1 AND `id` = :id ";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':id', $work_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }

    //取得登入中的使用者資料,$id為使用者id
    public function get_login_user_information()
    {
        $sql = "SELECT `username`, `contact_number`, `birthday`, `gender` FROM `user` WHERE `id` = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':id', $_SESSION['login_user']['id'], PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }

    //檢驗帳號密碼是否正確,$username為帳號,$password為密碼
    public function verify_user($username, $password)
    {
        $password = md5($password);
        $sql = "SELECT `id`,
                       `username`,
                       `nickname`,
                       `email_address`,
                       `manager`,
                       `validation`
                FROM `user`
                WHERE `username` = :username AND `password` = :password";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            $data_array = $query->fetch(PDO::FETCH_ASSOC);
            //檢查此組帳密是否已經完成驗證
            if ($data_array['validation'] === 1)
            {
                $_SESSION['login_user'] = array('id' => $data_array['id'], 'nickname' => $data_array['nickname'], 'manager' => $data_array['manager'], 'stat' => TRUE);
                return TRUE;
            }
            else
            {
                $result_array = array(
                    'username' => $data_array['username'],
                    'nickname' => $data_array['nickname'],
                    'email_address' => $data_array['email_address']
                );
                return $result_array;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //檢驗指定的帳號是否存在,$username為帳號
    public function verify_username($username)
    {
        $sql = "SELECT COUNT(*) FROM `user` WHERE `username` = :username";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $data_array = $query->fetchColumn();
        if ($data_array >= 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //檢驗指定的暱稱是否存在,$nickname為暱稱
    public function verify_nickname($nickname)
    {
        $sql = "SELECT COUNT(*) FROM `user` WHERE `nickname` = :nickname";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $query->execute();
        $data_array = $query->fetchColumn();
        if ($data_array >= 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //檢驗指定的電子郵件是否存在,$email_address為電子郵件地址
    public function verify_email_address($email_address)
    {
        $sql = "SELECT COUNT(*) FROM `user` WHERE `email_address` = :email_address";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':email_address', $email_address, PDO::PARAM_STR);
        $query->execute();
        $data_array = $query->fetchColumn();
        if ($data_array >= 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //搜尋文章存在與否,$keyword為搜尋關鍵字
    public function search_article($keyword)
    {
        $keyword = "%".$keyword."%";
        $sql = "SELECT COUNT(*) FROM `article` WHERE `title` LIKE :keyword1 OR `content` LIKE :keyword2";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':keyword1', $keyword, PDO::PARAM_STR);
        $query->bindValue(':keyword2', $keyword, PDO::PARAM_STR);
        $query->execute();
        $data_array = $query->fetchColumn();
        if ($data_array > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //新增使用者,$email_address為電子郵件地址,$username為帳號,$password為密碼,$nickname為暱稱,$management為管理權限有無值
    public function add_user($email_address, $username, $password, $nickname, $management)
    {
        $password = md5($password);
        $current_datetime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `user` (`email_address`, `username`, `password`, `nickname`, `registered_datetime`, `manager`, `validation`)
                VALUE (:email_address, :username, :password, :nickname, :current_datetime, :management, 1)";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':email_address', $email_address, PDO::PARAM_STR);
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->bindValue(':management', $management, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //註冊使用者,$gender為性別,$birthday為生日,$contact_number為連絡電話,$email_address為電子郵件地址,$username為帳號,$password為密碼,$nickname為暱稱
    public function register_user($gender, $birthday, $contact_number, $email_address, $username, $password, $nickname)
    {
        if ($gender === '')
        {
            $gender = NULL;
        }
        if ($birthday === '')
        {
            $birthday = NULL;
        }
        if ($contact_number === '')
        {
            $contact_number = NULL;
        }
        $password = md5($password);
        $validation_code = str_pad(strval(rand(0, 999999)), 6, '0', STR_PAD_LEFT);
        $current_datetime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `user` (`gender`, `birthday`, `contact_number`, `email_address`, `username`, `password`, `nickname`, `registered_datetime`, `validation_code`)
                VALUE (:gender, :birthday, :contact_number, :email_address, :username, :password, :nickname, :current_datetime, :validation_code)";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':gender', $gender, PDO::PARAM_STR);
        $query->bindValue(':birthday', $birthday, PDO::PARAM_STR);
        $query->bindValue(':contact_number', $contact_number, PDO::PARAM_STR);
        $query->bindValue(':email_address', $email_address, PDO::PARAM_STR);
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->bindValue(':validation_code', $validation_code, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return $validation_code;
        }
        else
        {
            return FALSE;
        }
    }

    //檢查指定使用者的認證狀況,$nickname為暱稱,$email_address為電子郵件地址
    public function inspect_user_validation($nickname, $email_address)
    {
        $sql = "SELECT `validation_code`, `validation` FROM `user` WHERE `nickname` = :nickname AND `email_address` = :email_address";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $query->bindValue(':email_address', $email_address, PDO::PARAM_STR);
        $query->execute();
        $data_array = $query->fetch(PDO::FETCH_ASSOC);
        if ($data_array !== FALSE)
        {
            if ($data_array['validation'] === 1)
            {
                if (isset($_SERVER['HTTP_REFERER']))
                {
                    $url = $_SERVER['HTTP_REFERER']."?msg=$nickname 已完成認證,無需再次認證";
                }
                else
                {
                    $url = "http://localhost/news/index.php?msg=$nickname 已完成認證,無需再次認證";
                }
                header("Location:$url");
            }
            else
            {
                return $data_array['validation_code'];
            }
        }
        else
        {
            header('Location:http://localhost/news/index.php');
        }
    }

    //驗證信箱,$email_address為電子郵件地址,$validation_code為認證碼
    public function validate_email_address($email_address, $validation_code)
    {
        $sql = "SELECT `id`, `nickname`, `manager` FROM `user` WHERE `email_address` = :email_address AND `validation_code` = :validation_code";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':email_address', $email_address, PDO::PARAM_STR);
        $query->bindValue(':validation_code', $validation_code, PDO::PARAM_STR);
        $query->execute();
        $data_array = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount() === 1)
        {
            $sql = "UPDATE `user` SET `validation_code` = NULL, `validation` = 1 WHERE `email_address` = :email_address";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(':email_address', $email_address, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() === 1)
            {
                $_SESSION['login_user'] = array('id' => $data_array['id'], 'nickname' => $data_array['nickname'], 'manager' => $data_array['manager'], 'stat' => TRUE);
                return TRUE;
            }
            else
            {
               return 2;
            }
        }
        else
        {
           return 1;
        }
    }

    //新增留言,$comment為留言內容,$id為文章或作品id,$source為來源
    public function add_comment($comment, $id, $source)
    {
        $current_datetime = date('Y-m-d H:i:s');
        $login_user_id = $_SESSION['login_user']['id'];
        $sql = "INSERT INTO `comment` (`content`, `create_datetime`, `create_user_id`, `{$source}`) VALUE (:comment, :current_datetime, :user_id, :id)";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':comment', $comment, PDO::PARAM_STR);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->bindValue(':user_id', $login_user_id, PDO::PARAM_INT);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //新增文章,$title為標題,$category為分類,$content為內文,$publish為發布與否值
    public function add_article($title, $category, $content, $publish)
    {
        $current_datetime = date('Y-m-d H:i:s');
        $content = nl2br($content);
        $sql = "INSERT INTO `article` (`title`, `category`, `content`, `publish`, `create_datetime`)
                VALUE (:title, :category, :content, :publish, :current_datetime)";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':category', $category, PDO::PARAM_STR);
        $query->bindValue(':content', $content, PDO::PARAM_STR);
        $query->bindValue(':publish', $publish, PDO::PARAM_INT);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //新增作品,$title為標題,$intro為簡介,$video_path為影片路徑,$youtube_link為YOUTUBE連結,$publish為發布與否值
    public function add_work($title, $intro, $video_path, $youtube_link, $publish)
    {
        $current_datetime = date('Y-m-d H:i:s');
        $intro = nl2br($intro);
        if ($video_path === '')
        {
            $video_path = NULL;
        }
        if ($youtube_link === '')
        {
            $youtube_link = NULL;
        }
        else
        {
            $youtube_link = "https://www.youtube.com/embed/$youtube_link";
        }
        $create_user_id = $_SESSION['login_user']['id'];
        $sql = "INSERT INTO `work` (`title`, `intro`, `video_path`, `youtube_link`, `publish`, `create_datetime`, `create_user_id`)
                VALUE (:title, :intro, :video_path, :youtube_link, :publish, :current_datetime, :create_user_id)";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':intro', $intro, PDO::PARAM_STR);
        $query->bindValue(':video_path', $video_path, PDO::PARAM_STR);
        $query->bindValue(':youtube_link', $youtube_link, PDO::PARAM_STR);
        $query->bindValue(':publish', $publish, PDO::PARAM_INT);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->bindValue(':create_user_id', $create_user_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //取得全部文章
    public function get_all_article()
    {
        $sql= "SELECT `id`, `title`, `category`, `publish`, `create_datetime` FROM `article`" ;
        $query = $this->dbh->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0)
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }

    //取得全部使用者
    public function get_all_user()
    {
        $sql= "SELECT `id`, `username`, `nickname`, `email_address` FROM `user`";
        $query = $this->dbh->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0)
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }

    //取得全部作品
    public function get_all_work()
    {
        $sql = "SELECT `id`, `title`, `intro`, `video_path`, `youtube_link`, `publish`, `create_datetime` FROM `work`" ;
        $query = $this->dbh->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0)
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
           return FALSE;
        }
    }

    //取得全部留言
    public function get_all_comment()
    {
        $sql = "SELECT `id`,
                       `content`,
                       `create_datetime`,
                       `modify_datetime`,
                       (SELECT `nickname` FROM `user` WHERE `id` = `create_user_id`) AS create_user_nickname,
                       `article_id`,
                       `work_id`,
                CASE
                    WHEN `article_id` IS NOT NULL THEN (SELECT `title` FROM `article` WHERE `id` = `article_id`)
                    ELSE NULL
                END AS article_title,
                CASE
                    WHEN `work_id` IS NOT NULL THEN (SELECT `title` FROM `work` WHERE `id` = `work_id`)
                    ELSE NULL
                END AS work_title
                FROM `comment`";
        $query = $this->dbh->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0)
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }

    //刪除指定的文章,$article_id為文章id
    public function delete_article($article_id)
    {
        $sql = "DELETE FROM `article` WHERE `id` = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':id', $article_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //刪除指定的使用者,$user_id為使用者id
    public function delete_user($user_id)
    {
        $sql = "DELETE FROM `user` WHERE `id` = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':id', $user_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //刪除留言,$comment_id為留言id
    public function delete_comment($comment_id)
    {
        $sql = "DELETE FROM `comment` WHERE `id` = :comment_id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
           return FALSE;
        }
    }

    //刪除作品,$work_id為作品id
    public function delete_work($work_id)
    {
        $sql = "SELECT `video_path` FROM `work` WHERE `id` = :work_id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':work_id', $work_id, PDO::PARAM_INT);
        $query->execute();
        $video_path = $query->fetchColumn();
        if ($video_path !== NULL)
        {
            if (file_exists('../'.$video_path))
            {
                unlink('../'.$video_path);
            }
        }
        $sql = "DELETE FROM `work` WHERE `id` = :work_id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':work_id', $work_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //編輯文章,$id為文章id,$title為標題,$category分類,$content為內文,$publish為發布與否值
    public function edit_article($id, $title, $category, $content, $publish)
    {
        $current_datetime = date("Y-m-d H:i:s");
        $content = nl2br($content);
        $sql = "UPDATE `article`
                SET `title` = :title,
                    `category` = :category,
                    `content` = :content,
                    `publish` = :publish,
                    `modify_datetime` = :current_datetime,
                    `edit_count` = `edit_count` + 1
                WHERE `id` = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':category', $category, PDO::PARAM_STR);
        $query->bindValue(':content', $content, PDO::PARAM_STR);
        $query->bindValue(':publish', $publish, PDO::PARAM_INT);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //編輯作品,$work_id為作品id,$title為標題,$intro為簡介,$video_path為影片路徑,$youtube_link為YOUTUBE連結,$publish為發布與否值
    public function edit_work($work_id, $title, $intro, $video_path, $youtube_link, $publish)
    {
        $current_datetime = date("Y-m-d H:i:s");
        if ($video_path === '')
        {
            $video_path = NULL;
        }
        if ($youtube_link == '')
        {
            $youtube_link = NULL;
        }
        else
        {
            $youtube_link = "https://www.youtube.com/embed/$youtube_link";
        }
        $intro = nl2br($intro);
        $sql = "UPDATE `work`
                SET `title` = :title,
                    `intro` = :intro,
                    `video_path` = :video_path,
                    `youtube_link` = :youtube_link,
                    `publish` = :publish,
                    `modify_datetime` = :current_datetime
                WHERE `id` = :work_id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':intro', $intro, PDO::PARAM_STR);
        $query->bindValue(':video_path', $video_path, PDO::PARAM_STR);
        $query->bindValue(':youtube_link', $youtube_link, PDO::PARAM_STR);
        $query->bindValue(':publish', $publish, PDO::PARAM_INT);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->bindValue(':work_id', $work_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //編輯使用者,$id為使用者id,$password為密碼,$management為管理權限有無值
    public function edit_user($id, $password, $management)
    {
        $current_datetime = date('Y-m-d H:i:s');
        if ($password !== '')
        {
            $password = md5($password);
            $password = "`password` = '{$password}',";
        }
        $sql = "UPDATE `user` SET $password `manager` = :management, `modify_datetime` = :current_datetime WHERE `id` = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':management', $management, PDO::PARAM_STR);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //變更帳戶設定,$password為密碼,$gender為性別,$birthday為生日,$contact_number為連絡電話
    public function edit_account_setting($password, $gender, $birthday, $contact_number)
    {
        $current_datetime = date('Y-m-d H:i:s');
        if ($password !== '')
        {
            $password = md5($password);
            $password = "`password` = '{$password}',";
        }
        if ($gender === '')
        {
            $gender = NULL;
        }
        if ($birthday === '')
        {
            $birthday = NULL;
        }
        if ($contact_number === '')
        {
            $contact_number = NULL;
        }
        $sql = "UPDATE `user`
                SET $password
                    `gender` = :gender,
                    `birthday` = :birthday,
                    `contact_number` = :contact_number,
                    `modify_datetime` = :current_datetime
                WHERE `id` = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':gender', $gender, PDO::PARAM_STR);
        $query->bindValue(':birthday', $birthday, PDO::PARAM_STR);
        $query->bindValue(':contact_number', $contact_number, PDO::PARAM_STR);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->bindValue(':id', $_SESSION['login_user']['id'], PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //編輯電子郵件地址,$nickname為暱稱,$email_address為電子郵件地址
    public function edit_email_address($nickname, $email_address)
    {
        $current_datetime = date('Y-m-d H:i:s');
        $sql = "UPDATE `user` SET `email_address` = :email_address, `modify_datetime` = :current_datetime WHERE `nickname` = :nickname";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':email_address', $email_address, PDO::PARAM_STR);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //編輯留言,$comment_id為留言id,$comment_content為留言內容
    public function edit_comment($comment_id, $comment_content)
    {
        $current_datetime = date('Y-m-d H:i:s');
        $sql = "UPDATE `comment`
                SET `content` = :comment_content,
                    `modify_datetime` = :current_datetime,
                    `edit_count` = `edit_count` + 1
                WHERE `id` = :comment_id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':comment_content', $comment_content, PDO::PARAM_STR);
        $query->bindValue(':current_datetime', $current_datetime, PDO::PARAM_STR);
        $query->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //重新創建認證碼,$email_address為電子郵件地址
    public function recreate_validation_code($email_address)
    {
        $validation_code = str_pad(strval(rand(0, 999999)), 6, '0', STR_PAD_LEFT);
        $sql = "UPDATE `user` SET `validation_code` = :validation_code WHERE `email_address` = :email_address";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':validation_code', $validation_code, PDO::PARAM_STR);
        $query->bindValue(':email_address', $email_address, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return $validation_code;
        }
        else
        {
            return FALSE;
        }
    }

    //取得指定的文章,$article_id為文章id
    public function get_designated_article($article_id)
    {
        $sql = "SELECT `title`, `category`, `content`, `publish` FROM `article` WHERE `id` = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':id', $article_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }

    //取得指定的作品,$work_id為作品id
    public function get_designated_work($work_id)
    {
        $sql = "SELECT `title`, `intro`, `video_path`, `youtube_link`, `publish` FROM `work` WHERE `id` = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':id', $work_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }

    //取得指定使用者,$id為使用者id
    public function get_designated_user($id)
    {
        $sql = "SELECT `id`, `username`, `manager` FROM `user` WHERE `id`='{$id}'";
        $query = $this->dbh->prepare($sql);
        $query->execute();
        if ($query->rowCount() === 1)
        {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return FALSE;
        }
    }
}
?>
