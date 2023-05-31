<?php

interface IDatabase
{
  public static function createConnection();

  /**
   * Instância do banco de dados
   */
  public static function getInstance();

  /**
   * Conexão atual do banco de dados
   */
  public static function getConnection();
}
