<?php
Class Dbase{
    
    /*** EG Insert

        $table = 'customer';
     	$values = array(
            'id_customer' => 1,
            'customer_name' => "Eylül BENEK",
            'customer_britday' => "15.09.2014",
            'customer_active' => 1
     	);
     	$insert = Dbase::insert($table, $values );

     **/
    
    /*** INSER INTO database  **/
    public function insert($table,  $values) {
        $db = new DB();
        
        $prep = array();
        foreach($values as $k => $v ) {
            $prep[':'.$k] = $v;
        }
        $sth = $db->prepare("INSERT OR IGNORE INTO ".$table." ( " . implode(', ',array_keys($values)) . ") VALUES (" . implode(', ',array_keys($prep)) . ")");
        $res = $sth->execute($prep);
        return $db->lastInsertId();
        
        
    }
    
    /*** UPDATE database *
    
    $table = 'customer';
     	$values = array(
            'customer_name' => "Eylül BENEK",
            'customer_britday' => "15.09.2014",
            'customer_active' => 1
     	);
     	$insert = Dbase::update($table, $values, 'id_customer = 1' );
     	
    */
    public function update($table,  $values, $condition) {
        $db = new DB();
        
        $prep = array();
        foreach($values as $k => $v ) {
            $prep[$k.' = :'.$k] = $v;
        }
        
        $sth = $db->prepare("UPDATE ".$table." SET ".  implode(', ',array_keys($prep)) ."  WHERE ".$condition."");
        $res = $sth->execute($values);
        
        
    }
    
    /** Update one row Value eg: Dbase::updateOneRow('product', 'product_name = "New Name" ', 'id_product = 8') **/
    public static function updateOneRow($table,  $row, $condition) {
        $db = new DB();
        $updateOneRow = $db->prepare("UPDATE ".$table." SET ".  $row ."  WHERE ".$condition."");
        return $updateOneRow->execute();
    }
    
    /** DELETE Value eg: Dbase::delete('product', 'id_product = 8') **/
    public function delete($table,  $condition) {
        $db = new DB();
        
        $deleteRow = $db->query('DELETE FROM '.$table.' WHERE '.$condition.' LIMIT 1');
        return $deleteRow;
        
        
    }
    
    /** GET eg: Dbase::getRows('*', 'products', 'products_id = 12') **/

    public function getRows($which, $table,  $condition) {

        $db = new DB();
        
        $gettable = $db->query('SELECT '.$which.' FROM '.$table.' WHERE '.$condition.'');
        
        if($gettable){
            return $gettable;
        }
        else{
            echo "<span class='databaseError'>".'SELECT '.$which.' FROM '.$table.' WHERE '.$condition.''."</span>";
        }

        
        
    }
    
    /** GET ROW eg: Dbase::getRow('products', 'products_id = 12', 'products_name') **/

    public function getRow($table,  $condition, $value) {

        $db = new DB();
        
        $getRow = $db->query('SELECT '.$value.' FROM '.$table.' WHERE '.$condition.' LIMIT 1');
        
        if($getRow){
            foreach ($getRow as $row){
                return $row[$value];
            }
        }
        else{
            echo "<span class='databaseError'>".'SELECT '.$value.' FROM '.$table.' WHERE '.$condition.' LIMIT 1'."</span>";
        }
    }
    
    
    
    /** Is exist eg: Dbase::isExist('customer', 'id_customer = 1') **/
        
    public function isExist($table,  $condition) {
        $db = new DB();
        
        $gettable = $db->query('SELECT COUNT( * ) AS result FROM '.$table.' WHERE '.$condition.'', PDO::FETCH_ASSOC);
        if($gettable){
            foreach($gettable as $g){
                $result = $g['result'];
            }
            if($result > 0){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            echo "<span class='databaseError'>".'SELECT COUNT( * ) AS result FROM '.$table.' WHERE '.$condition.''."</span>";
        }
    }
    
    /** GET ROW eg: Dbase::getSum('boughtProducts', 'bp_products_id = 12', 'bp_amount') **/

    public function getSum($table,  $condition, $value) {

        $db = new DB();
        
        $getRow = $db->query('SELECT sum('.$value.') AS count FROM '.$table.' WHERE '.$condition.'');
        
        if($getRow){
            foreach ($getRow as $row){
                return $row['count'];
            }
        }
        else{
            echo "<span class='databaseError'>".'SELECT sum('.$value.') AS count FROM '.$table.' WHERE '.$condition.''."</span>";
        }

        
        
    }
    
    /** GET ROW eg: Dbase::getCount('products', 'products_status = 1', 'products_id') **/

    public function getCount($table,  $condition, $value) {

        $db = new DB();
        
        $getRow = $db->query('SELECT count('.$value.') AS value FROM '.$table.' WHERE '.$condition.'');

        if($getRow){
            foreach ($getRow as $row){
                return $row['value'];
            }
        }
        else{
            echo "<span class='databaseError'>".'SELECT count('.$value.') AS count FROM '.$table.' WHERE '.$condition.''."</span>";
        }
        
    }
}
?>
