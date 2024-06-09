<?php
class Message {

    private $url;

    public function __construct($url) {
        $this->url = $url;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    //saves a new message and receives a value to be redirected
    public function setMessage($msg, $type, $redirect = "index.php") {
        $_SESSION["msg"] = $msg;
        $_SESSION["type"] = $type;
        
        if (!headers_sent()) {
            if ($redirect != "back") {
                header("Location: " . $this->url . "/" . $redirect);
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
            exit; // Certifique-se de sair após o redirecionamento
        } else {
            echo "<script type='text/javascript'>window.location.href='{$this->url}/{$redirect}';</script>";
            echo "<noscript><meta http-equiv='refresh' content='0;url={$this->url}/{$redirect}'></noscript>";
            exit;
        }
    }

    //returns the message to be printed to the user
    public function getMessage() {
        if (!empty($_SESSION["msg"]) && !empty($_SESSION["type"])) {
            $message = ["msg" => $_SESSION["msg"], "type" => $_SESSION["type"]];
            $this->dropMessage(); // Limpa a mensagem após recuperá-la
            return $message;
        } else {
            return false;
        }
    }

    //clear session message
    public function dropMessage() {
        unset($_SESSION["msg"]);
        unset($_SESSION["type"]);
    }
}
?>
