<?php

class User
{
	/**
	 * @var int|null
	 */
	private ?int $id = null;
	/**
	 * @var string
	 */
	private string $email;
	/**
	 * @var int
	 */

	private int $cookie; //Udržovat stále, nebo jen zjistit jen při loginu?
	/**
	 * @var int
	 */
	private int $time = PHP_INT_MIN;
    private Database $db;

	public function __construct($d)
	{
		$this->db = $d;
		
		if (isset($_COOKIE["Account"])) {
			$cookie = $_COOKIE["Account"];
			
			$this->checkCookie($cookie);
		}
	}
	
	/**
	 * @param string $token
	 *
	 * @return void
	 */
	public function checkCookie(string $token): void
	{
		$this->db->query("SELECT user,  ip FROM user_cookie WHERE token = :tok");
		$this->db->bind(":tok", $token);
		$info = $this->db->single();
		
		$time = time() + 7200;
		
		if ($info["ip"] === inet_pton($_SERVER["REMOTE_ADDR"])) {
            $this->db->query("SELECT u.id, u.email FROM user AS u  WHERE u.id = :id");
            $this->db->bind(":id", $info["user"]);
            if ($account = $this->db->single()) {
				$this->id = $info["user"];
				$this->email = $account["email"];
			} else {
				$this->deleteCookie();
			}

		} else {
			$this->deleteCookie();
		}
	}
	
	/**
	 * @return void
	 */
	public function deleteCookie(): void
	{
		if (isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			
			foreach ($cookies as $cookie) {
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', -1, '/', $_SERVER["SERVER_NAME"]);
			}
			
			header("Location: https://test.revelio.cz");
		}
		
		echo "<script>console.log('Nesedí ti cookie!');</script>";
	}
	
	/**
	 * @return bool
	 */
	public function issetID(): bool
	{
		return $this->getID() !== null;
	}
	
	/**
	 * @return int|null
	 */
	public function getID(): ?int
	{
		return $this->id;
	}
	
	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}
	

	public function update(): bool
	{
		$this->db->query("UPDATE user SET ip = :ip WHERE id = :id");
		$this->db->bind(":ip", inet_pton($_SERVER["REMOTE_ADDR"]));
		$this->db->bind(":id", $this->id);
		if ($this->db->execute()) {
			return true;
		}
		
		return false;
	}
	

}
