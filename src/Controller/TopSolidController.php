<?php




namespace App\Controller;



use App\Entity\TopSolid\ipdm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


/**
 * Class TopSolidController
 * @package App\Controller
 * @Route("/TopSolid")
 */
class TopSolidController extends AbstractController
{
    public static string $base_url = "https://localhost:44305/api/";
/*//    /**
//     * @Route("/")
//     * @return Response
//     */
//    public function index(): Response
//    {
//        $object = new \COM('TestPhp.Class1');
//        //$object = new \DOTNET('TestPhp','Class1');
//        dump($object->HelloWorld());
//        dump($object->Connect());
//        dump($object->IsConnected());
//        dump($object->Document());
//        dump($object->VersionTSHost());
//        dump($object->Projectss());
//        $v = new variant($object->Projectss());
//
//        dump( "The value is " . $v  );
//        $object->Disconnect();
//
//        return $this->render('TopSolid/index.html.twig');
//    }*/


    /**
     * @Route("/",  methods={"GET"})
     * @return Response
     */
    public function index(): Response
    {
        $client = new CurlHttpClient();
        $response = $client->request('GET',self::$base_url."/project/",[
            // ...
            'verify_peer' => false,
//        'extra' => [
//            'curl' => [
//                CURLOPT_SSL_VERIFYPEER => false,
//                CURLOPT_SSL_VERIFYSTATUS => false
//            ]
//        ]
        ]);
        try {
            $projectTS = $response->toArray();

        }

         catch (TransportExceptionInterface $e) {
            $this->addFlash('error','impossible dacceder au web service TS ' . $e);
            $projectTS = [];
        }
        dump($projectTS);
        return $this->render('TopSolid/index.html.twig',[
            'projectTS'=>$projectTS
        ]);
    }

    /**
     * @Route("/{id}",methods={"GET"})
     * @return Response
     */
    public function show($id): Response
    {
        $client = new CurlHttpClient();
        $response = $client->request('GET',self::$base_url."project/$id",[
            // ...
            'verify_peer' => false,
//        'extra' => [
//            'curl' => [
//                CURLOPT_SSL_VERIFYPEER => false,
//                CURLOPT_SSL_VERIFYSTATUS => false
//            ]
//        ]
        ]);
        try {
            $projectTS = $response->toArray();

        }
        catch (TransportExceptionInterface $e) {
            $this->addFlash('error','impossible dacceder au web service TS');
            $projectTS = [];
        }
        return $this->render('TopSolid/show.html.twig',[
            'projectTS'=>$projectTS
        ]);
    }

    /**
     * @Route("/", "topsolid.post", methods={"POST"})
     */
    public function post(Request $request, SerializerInterface $serializer): Response
    {


        $id = $request->request->get("id");
        $pdmid = new ipdm($id);

        //dump($pdmid->serialize());
        $json = $serializer->serialize(
            $pdmid,
            'json',
            ['groups' => 'default']
        );

        $client = new CurlHttpClient();
        $response = $client->request('POST',self::$base_url."project",[
            // ...
            'verify_peer' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            //'json' => $json,
            'body' => $json
        ]);
        $ipdmobject = $response->toArray();

        dump($ipdmobject);
        return $this->render('TopSolid/tests.html.twig', [
            "ipdmobject" => $ipdmobject
        ]);
    }

    /**
     * @Route("/Document", "topsolid.Document", methods={"POST"})
     */
    public function Document(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->request->get("id");
        $pdmid = new ipdm($id);

        //dump($pdmid->serialize());
        $json = $serializer->serialize(
            $pdmid,
            'json',
            ['groups' => 'default']
        );
        $client = new CurlHttpClient();
        $response = $client->request('POST',self::$base_url. "document",[
            // ...
            'verify_peer' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            //'json' => $json,
            'body' => $json
        ]);
        $ipdmobject = $response->toArray();

        dump($ipdmobject);
        return $this->render("TopSolid/Document.html.twig",[
            "ipdmobject" => $ipdmobject
        ]);
    }

    /**
     * @Route("/shape", "topsolid.shape", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function Shape(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->request->get("id");
        $pdmid = new ipdm($id);

        //dump($pdmid->serialize());
        $json = $serializer->serialize(
            $pdmid,
            'json',
            ['groups' => 'default']
        );
        $client = new CurlHttpClient();
        $response = $client->request('POST',self::$base_url. "shape",[
            // ...
            'verify_peer' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            //'json' => $json,
            'body' => $json
        ]);
        $ipdmobject = $response->toArray();

        dump($ipdmobject);
        return $this->render("TopSolid/Shapes.html.twig",[
            "ipdmobject" => $ipdmobject,
            "idobject" => $id,
            "retour" => $ipdmobject
        ]);
    }
}