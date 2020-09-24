<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\RequestStack;

class UtilitariosController extends Controller{

    public function loremipsum(Request $request){
        $paragraph = [
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ullamcorper ut odio eu consectetur. Aliquam facilisis nunc eget eros vehicula, ac volutpat dui viverra. Vivamus tincidunt bibendum orci a tincidunt. Mauris dapibus facilisis gravida. Nam egestas bibendum odio vel condimentum. Maecenas dignissim quam odio, vel feugiat nunc fringilla et. In dapibus varius dolor vel placerat. Mauris at volutpat ex. Quisque sapien arcu, accumsan ac ornare tempor, tristique in nulla. Curabitur eros ligula, pellentesque vehicula volutpat hendrerit, condimentum ultrices nunc. Cras imperdiet imperdiet felis, vitae interdum ante venenatis id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis et massa faucibus, tempor augue sit amet, sodales lacus. Praesent congue lacus ac iaculis sodales. Phasellus sit amet ex nibh. Proin non fringilla purus.",
            "Suspendisse ultrices, tortor id pulvinar cursus, tortor libero rutrum orci, sit amet lacinia lectus augue nec dui. Duis interdum condimentum magna, vitae sollicitudin sem tincidunt varius. Fusce ullamcorper justo diam, aliquam finibus sem congue at. Duis id arcu purus. Cras non condimentum nulla. Curabitur lacinia ante sit amet quam malesuada, sit amet porta erat varius. Vivamus quis commodo mi. Sed vitae placerat magna, quis iaculis mauris. Cras iaculis nisi risus, eget cursus nisl suscipit vel.",
            "Curabitur pulvinar eleifend justo quis tempor. Mauris ut dignissim neque. Aenean id libero et tortor tincidunt ullamcorper. Maecenas non porta justo, vel lobortis lacus. Suspendisse venenatis felis a euismod tincidunt. Nunc vel tristique massa. Donec eget ipsum quam. Nulla tincidunt venenatis euismod. Sed facilisis at tortor et imperdiet. Etiam nisi magna, pulvinar a varius id, mollis eu sem. In mattis nisl nunc, quis posuere enim consequat eu. Suspendisse eu volutpat dolor. Maecenas pharetra rutrum rutrum. Morbi convallis, enim vitae bibendum eleifend, enim purus pharetra magna, posuere iaculis ante augue eget lacus. Donec imperdiet, sapien quis dictum elementum, mauris orci varius nunc, ac ornare ipsum dui gravida felis.",
            "Quisque sollicitudin sapien at massa congue finibus. Ut vitae volutpat nulla. Donec nisl dui, consectetur in ipsum sed, fringilla eleifend eros. Integer faucibus convallis vulputate. Donec maximus turpis suscipit, maximus neque a, lacinia risus. Nullam a volutpat ante. Aenean in urna porta, ullamcorper leo vitae, pharetra risus. Nunc viverra molestie massa, eget pulvinar enim. Nullam interdum id mauris consequat posuere. Nulla facilisi.",
            "Vestibulum ac tincidunt leo. Mauris tristique leo vitae massa ullamcorper elementum. Etiam vulputate lectus eget mi condimentum, eu mattis quam volutpat. Cras scelerisque volutpat dui, sed iaculis nulla luctus eget. Maecenas ac nisi arcu. Nam sit amet venenatis mauris. Praesent fringilla ultrices mi, eget tristique risus efficitur et. Pellentesque iaculis sed ligula sed malesuada. Nulla placerat egestas pellentesque. Morbi viverra varius elementum. Curabitur varius quis sapien sit amet laoreet. Integer mi magna, luctus non neque id, consectetur suscipit nisl. Sed nec tincidunt massa. Aliquam dignissim congue erat, sed finibus lectus sodales id. Duis suscipit risus a interdum vehicula.",
            "Vestibulum rutrum viverra velit. Nullam accumsan dui ut pulvinar semper. Quisque vitae tortor in eros vestibulum convallis. Curabitur vel tempor arcu, eget fringilla ante. Duis lacinia, dui vulputate tincidunt pharetra, enim elit placerat turpis, vel lobortis quam dui eget metus. Nullam dolor ex, efficitur vitae ante at, tempus ullamcorper lectus. Etiam vel mi sit amet augue iaculis dignissim ac nec massa. Nullam ut leo vel turpis aliquet faucibus vel sed ligula. Quisque ligula felis, aliquet vitae elit non, maximus congue dolor. Sed malesuada rutrum nisi, id molestie dui tristique ornare. Cras condimentum vitae erat ut eleifend. Cras lobortis iaculis quam, quis posuere massa aliquam vulputate.",
            "In vitae nisl ultrices, ornare enim viverra, faucibus purus. Praesent est lorem, ornare volutpat luctus ut, porta eu nisi. Suspendisse mollis arcu justo, a rhoncus metus consequat nec. Phasellus posuere sit amet ex vel commodo. Integer malesuada scelerisque nisi. Morbi cursus, odio in cursus sodales, arcu nunc ultricies orci, in imperdiet mi felis auctor ipsum. Cras scelerisque felis ac mi ullamcorper sollicitudin in in elit. Ut sollicitudin lacus et libero hendrerit, vitae tristique enim pharetra. Vestibulum eleifend varius enim pharetra accumsan. Fusce ac lacus in nisl elementum cursus.",
            "Proin vel egestas nisi, finibus maximus justo. Suspendisse potenti. Phasellus porta, leo nec fermentum euismod, augue nulla ullamcorper mi, eu interdum nulla orci vel metus. Nam maximus sodales augue sed consectetur. Nunc lorem risus, rhoncus id mi id, cursus dictum nisl. Morbi vestibulum purus ut nisl semper, non congue quam elementum. Duis tincidunt nisl nunc, quis eleifend nunc elementum in. Ut ornare finibus nibh eget finibus. Ut non fermentum nunc. In placerat libero vitae molestie scelerisque. Vestibulum sodales quam cursus lectus aliquet tempus. Sed sem eros, lacinia id efficitur egestas, pharetra id purus.",
            "Maecenas lacus tellus, pellentesque vel auctor at, ultrices vitae orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi gravida neque et neque eleifend, vitae bibendum quam tincidunt. Praesent feugiat felis risus, pretium pulvinar augue congue at. Aliquam dui eros, interdum eget tellus eu, imperdiet pulvinar lectus. Quisque eget velit et est gravida aliquam. Integer convallis urna et elementum bibendum. Aenean vestibulum velit ligula, a consequat nulla ultrices et. Duis sollicitudin, sem nec pellentesque malesuada, velit neque volutpat turpis, non blandit purus ligula in urna.",
	    	"Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Curabitur porta ligula vitae lacus eleifend commodo. Fusce nec vulputate nulla. Praesent ut libero leo. Vestibulum eu purus ut nulla hendrerit pellentesque. Nam porttitor eros at laoreet facilisis. Sed semper urna ut tellus dignissim tempus. Vestibulum ultrices ut felis sed vulputate. Maecenas massa purus, vulputate quis elit a, tristique laoreet mauris. Morbi nec tellus quis justo molestie molestie."
	    ];

        $count = 0;
        $words = $request->words;
        $conteudo = $paragraph[0];
        $paragraphs = $request->paragraphs;

        if ($paragraphs){
            $conteudo = "";
            for ($i = 1; $i <= $paragraphs; $i++) {
                $conteudo = $conteudo . '<p>' . $paragraph[$i-1] . '</p>';
            }
        }

        try{
            return response()->json(
                $conteudo
            , 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

    public function upload(Request $request){
        /*
        $imgName = "imagem.png";
        $path = 'storage/upload/'.$imgName;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        */
        $imagem = "";
        $tipo = "";
        if ($request->tipo){
            $tipo = $request->tipo;
        }
        if ($request->imagem){
            $base64 = $request->imagem;
            $imagem = $this->convertBase64ToImage($base64, $tipo);
        }
        try{
            return response()->json(
                $imagem
                , 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

    public function convertBase64ToImage($photo = null, $path = null) {
        if (!empty($photo)) {
            $photo = str_replace('data:image/png;base64,', '', $photo);
            $photo = str_replace(' ', '+', $photo);
            $photo = str_replace('data:image/jpeg;base64,', '', $photo);
            $photo = str_replace('data:image/gif;base64,', '', $photo);
            $entry = base64_decode($photo);
            $image = imagecreatefromstring($entry);

            $fileName = time() . ".jpeg";
            $directory = "storage/upload/" . $path . '/' . $fileName;

            header('Content-type:image/jpeg');

            if (file_exists($directory)) {
                unlink($directory);
            }


            $saveImage = imagejpeg($image, $directory);

            imagedestroy($image);

            if ($saveImage) {
                return $fileName;
            } else {
                return false; // image not saved
            }
        }
    }

}
