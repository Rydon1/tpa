<?php
/**
 * Created by PhpStorm.
 * User: gerson
 * Date: 21/03/2020
 * Time: 08:32
 */

class Usuario
{

    private $id;
    private $email;
    private $nome;

    private $con;

    /**
     * Usuario constructor.
     * @param $id
     */
    public function __construct($id=null)
    {
        $this->id = $id;

        $this->con = new PDO(SERVIDOR, USUARIO, SENHA);

    }

    public function all(){


        $sql = $this->con->prepare("SELECT * FROM usuario");
        $sql->execute();

        $rows = $sql->fetchAll(PDO::FETCH_CLASS);

        return $rows;


    }
    
     public function create()
    {
        $sql = $this->con->prepare("INSERT INTO usuario (email, nome) VALUES (?,?)");
        $sql->execute([$this->email, $this->nome]);

        if ( $sql->errorCode()=='00000'){
            header("Location: ./");
        }else{
            echo "<div class='alert alert-danger'>".$sql->errorInfo()[2]."</div>";
        }

    }
    
    public function update(){
        
        $sql= $this->con->prepare("UPDATE usuario SET email=?, nome=? WHERE id=?");
        $sql->execute([$this->email, $this->nome, $this->id]);

        if ($sql->errorCode() == '00000') {
            header("Location: ./");
        } else {
            echo "<div class='alert alert-danger'>" . $sql->errorInfo()[2] . "</div>";
        }
        
    }
    
    public function delete(){

        $sql= $this->con->prepare("DELETE FROM usuario WHERE id=?");
        $sql->execute([$this->id]);

        if ($sql->errorCode() == '00000') {
            header("Location: ./");
        } else {
            echo "<div class='alert alert-danger'>" . $sql->errorInfo()[2] . "</div>";
        }
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }





}
