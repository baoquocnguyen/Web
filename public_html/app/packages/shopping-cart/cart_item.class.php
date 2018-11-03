<?php

class CartItem
{
	private $id			= -1;
	private $name		= '';
    private $code		= '';
    private $hinh		= '';
	private $desc		= '';
	private $price		= 0;
	private $quantity	= 1;
	private $slug	= '';
	
	public function __construct($id, $name,$hinh,$code,$desc,$price = 0, $quantity = 1, $slug)
	{
		$this->id		= $id;
		$this->name		= $name;
        $this->hinh		= $hinh;
        $this->code		= $code;
		$this->desc		= $desc;
		$this->price	= (float) $price;
        #$this->price	= (int) $price;
		$this->quantity	= $quantity;
		$this->slug	= $slug;
	}
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return $this->name;
	}
    public function getHinh()
	{
		return $this->hinh;
	}
    public function getCode()
	{
		return $this->code;
	}
	/*
	public function setName($name)
	{
		$this->name = $name;
	}
	*/
	
	public function getDesc()
	{
		return $this->desc;
	}
	
	public function getPrice()
	{
		return $this->price;
	}
	
	/*
	public function setPrice($price)
	{
		$this->price = $price;
	}
	*/
	
	public function getQuantity()
	{
		return $this->quantity;
	}
	
	public function getSlug()
	{
		return $this->slug;
	}
	
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}
}

?>