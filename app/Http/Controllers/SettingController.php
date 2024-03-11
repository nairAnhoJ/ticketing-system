<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SettingController extends Controller
{
    public function index(){
        $settings = DB::table('settings')->first();

        return view('admin.system-management.settings', compact('settings'));
    }

    public function test(Request $request){
        $hostServer = $request->hostServer;
        $username = $request->username;
        $password = $request->password;
        $name = $request->name;
        $port = $request->port;
        $reciever = $request->sendtest;

        // try {
            $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = "$hostServer";                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = "$username";                     //SMTP username
            $mail->Password   = "$password";                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom("$username", "$name");
            $mail->addAddress("$reciever");     //Add a recipient
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Test Email';
            $mail->Body    = 'This is a test email only.';
        
            $mail->send();
        // }
    }

    public function update(Request $request){
        if(isset($request->smtp_status)){
            if($request->password != null){
                DB::update('UPDATE settings SET smtp_is_activated = 1, smtp_server = ?, smtp_name = ?, smtp_username = ?, smtp_password = ?, smtp_port = ? WHERE id = 1', [$request->hostServer, $request->name, $request->username, $request->password, $request->port]);
            }else{
                DB::update('UPDATE settings SET smtp_is_activated = 1, smtp_server = ?, smtp_name = ?, smtp_username = ?, smtp_port = ? WHERE id = 1', [$request->hostServer, $request->name, $request->username, $request->port]);
            }
            return redirect()->route('settings.index');
        }else{
            DB::update('update settings set smtp_is_activated = 0 where id = 1');
            return redirect()->route('settings.index');
        }
    }

    public function uadIndex(){
        $settings = DB::table('settings')->first();

        return view('admin.system-management.uad-edit', compact('settings'));
    }

    public function uadTest(Request $request){
        $item = (object) [
            'user' => strtoupper('Salvador Felipe Jacinto Dalí y Domenech'),
            'date_issued' => date('m/d/Y'),
            'department' => 'IT',
            'site' => 'PARAÑAQUE',
            'desc' => 'MACBOOK PRO',
            'cost' => "300000",
            'serial_no' => '697842915379464',
            'color' => 'SILVER',
            'remarks' => 'WITH CHARGER',
            'status' => 'BRAND NEW',
            'item' => 'LAPTOP',
        ];

        $settings = (object) [
            "user_agreement_device" => $request->aud
        ];

        return view('inventory.issuance', compact('item', 'settings'));
    }

    public function uadupdate(Request $request){
        DB::table('settings')->where('id', 1)->update(['user_agreement_device' => $request->aud]);

        return redirect()->route('settings.index');
    }


    public function uapsIndex(){
        $settings = DB::table('settings')->first();

        return view('admin.system-management.uaps-edit', compact('settings'));
    }

    public function uapsTest(Request $request){
        $item = (object) [
            'user' => strtoupper('Salvador Felipe Jacinto Dalí y Domenech'),
            'date_issued' => date('m/d/Y'),
            'department' => 'IT',
            'site' => 'PARAÑAQUE',
            'desc' => 'APPLE IPHONE 14 PRO MAX',
            'cost' => "77990",
            'serial_no' => '3364982134685146',
            'color' => 'DEEP PURPLE',
            'remarks' => 'WITH CHARGER',
            'status' => 'BRAND NEW',
            'item' => 'PHONE',
        ];

        $settings = (object) [
            "user_agreement_phonesim" => $request->aups
        ];

        return view('inventory.issuance', compact('item', 'settings'));
    }

    public function uapsupdate(Request $request){
        DB::table('settings')->where('id', 1)->update(['user_agreement_phonesim' => $request->aups]);

        return redirect()->route('settings.index');
    }
}
