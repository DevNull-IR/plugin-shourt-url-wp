<nav style="font-size: 27px;
    margin-top: 10px;
    margin-bottom: 10px;">
    <a href="https://f1r.ir">about</a> |
    <a href="tg://resolve?domain=Dev_null">contact</a> |
    <a href="https://f1r.ir/panel">panel</a> 
    <!-- <a href="#">about</a>  -->
</nav>
<?php
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://dl.f1r.ir/extensions/wordpress/index.json",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = json_decode(curl_exec($curl));
    if (isset($response) && !empty($response)){
        if (isset($response->id) && !empty($response->id)){
            if(isset($response->message) && !empty($response->message)){
                $message = $response->message;
                $id = $response->id;
                $check_option = get_option($id . 'status_message_wp_f1r');
                if ($check_option == false){
                    add_option($id . 'status_message_wp_f1r');
                    update_option($id . 'status_message_wp_f1r' , 'view');
                }
                if($check_option == 'view'){
                    // update_option($id . 'status_message_wp_f1r' , 'false');
                    ?>
                        <div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible"> <p><strong><?= $message ?></strong></p><a type="button" class="notice-dismiss" onclick="close_notith()" href="<?= $_SERVER['REQUEST_URI'] ?>&wp_f1r_ok=false"></a></div>
                    <?php
                    
                }
            }
        }
    }
    if(isset($_GET['wp_f1r_ok'])){
        $a = $id-1;
        delete_option($a . 'status_message_wp_f1r');
        update_option($id . 'status_message_wp_f1r' , 'checked');
        $new = str_replace("&wp_f1r_ok=false" ,null , $_SERVER['REQUEST_URI']);
        $new = 'http://' . $_SERVER['HTTP_HOST'] . $new;
        // echo $new;
        ?>
        <!-- <meta http-equiv="refresh" content='0'; url='<?= $new ?>' > -->
        <meta http-equiv="refresh" content="0; url=<?= $new ?>">

        <?php
    } 
?>
<script>
    function close_notith(){
        document.getElementById('setting-error-settings_updated').setAttribute("style" , "display:none;");
    }
</script>