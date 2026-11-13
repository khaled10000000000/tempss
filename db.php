<?php
                          $database_file = './databasse3.db';
                          $connection = new PDO("sqlite:$database_file");
                          $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                       
                            ?>