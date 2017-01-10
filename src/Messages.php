<?php


/*
 * Class Messages:
 */
class Messages {

    private $id;
    private $adminId;
    private $text;
    private $creationDate;
    

    //Messages constructor

    public function __construct() {

        $this->id = -1;
        $this->adminId = '';
        $this->text = '';
        $this->creationDate = "";
    }
    /* 
     * Set and Get methods:
     */
    public function setAdminId($newAdminId) {
        $this->adminId = $newAdminId;
    }
    
    public function setText($newText) {
        $this->text = $newText;
    }
    
    public function setCreationDate($newDate) {
        $this->creationDate = $newDate;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getAdminId() {
        return $this->adminId;
    }
    
       
    public function getText() {
        return $this->text;
    }
    
        
    public function getCreationDate() {
        return $this->creationDate;
    }
    
    /*   
      
    
    static public function loadMessageById(mysqli $connection, $id) {

        $sql = "SELECT m.*, urecipient.username as recipientName, usender.username as senderName
                FROM Messages as m
                JOIN Users as urecipient ON m.recipientUserId = urecipient.id
                JOIN Users as usender ON m.senderUserId = usender.id
                WHERE m.id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedMessages = new Messages();
            $loadedMessages->id = $row['id'];
            $loadedMessages->senderUserId = $row['senderUserId'];
            $loadedMessages->recipientUserId = $row['recipientUserId'];
            $loadedMessages->senderUserName = $row['senderName'];
            $loadedMessages->recipientUserName = $row['recipientName'];
            $loadedMessages->text= $row['text'];
            $loadedMessages->isRead= $row['isRead'];
            $loadedMessages->creationDate= $row['creationDate'];

            return $loadedMessages;
        }

        return null;
    }
    
    
    static public function getMessagesBySenderUserId(mysqli $connection, $senderUserId) {
        
        $sql = "SELECT Messages.id,recipientUserId,text,isRead,creationDate,username 
                FROM Messages Join Users ON
                Users.id = Messages.recipientUserId
                where senderUserId = $senderUserId ORDER BY creationDate DESC";
        
        $ret = [];
        $result = $connection->query($sql);
        

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedSenderMessages = new Messages();
                $loadedSenderMessages->id = $row['id'];
                $loadedSenderMessages->recipientUserId = $row['recipientUserId'];
                $loadedSenderMessages->text= $row['text'];
                $loadedSenderMessages->isRead= $row['isRead'];
                $loadedSenderMessages->creationDate= $row['creationDate'];
                $loadedSenderMessages->recipientUserName= $row['username'];
                $ret[] = $loadedSenderMessages;
            }
        }   
        return $ret;
    }
    
    static public function getMessagesByRecipientUserId(mysqli $connection, $recipientUserId) {
        
        $sql = "SELECT Messages.id,senderUserId,username,text,isRead,creationDate 
                FROM Messages Join Users ON
                Users.id = Messages.senderUserId
                where recipientUserId =$recipientUserId ORDER BY creationDate DESC";
        
        $ret = [];
        $result = $connection->query($sql);
        

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedRecipientMessages = new Messages();
                $loadedRecipientMessages->id = $row['id'];
                $loadedRecipientMessages->senderUserId = $row['senderUserId'];
                $loadedRecipientMessages->text= $row['text'];
                $loadedRecipientMessages->isRead= $row['isRead'];
                $loadedRecipientMessages->creationDate= $row['creationDate'];
                $loadedRecipientMessages->senderUserName= $row['username'];
                $ret[] = $loadedRecipientMessages;
            }
        }   
        return $ret;
    }
    */
    
    /*
      Saving new comment to DB
     * 
     * 
     */
   /*
    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Messages (senderUserId, recipientUserId, isRead, text, creationDate)
                  VALUES ('$this->senderUserId','$this->recipientUserId', $this->isRead, '$this->text', '$this->creationDate')";
            
            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            } 
        } else {
            $sql = "UPDATE Messages SET isRead = 1
                    WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }
    
    */
}

