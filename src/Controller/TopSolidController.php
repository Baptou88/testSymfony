<?php




namespace App\Controller;



use App\Entity\TopSolid\ipdm;
use phpDocumentor\Reflection\Types\This;
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
        $response = $client->request('GET',"https://localhost:44336/api/project/",[
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
        $response = $client->request('GET',"https://localhost:44336/api/project/$id",[
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
        $response = $client->request('POST',"https://localhost:44336/api/project",[
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
        $response = $client->request('POST',"https://localhost:44336/api/document",[
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
     * @Route("/shapes","topsolid.Shapes", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function shapes(Request $request, SerializerInterface $serializer):Response
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
        $response = $client->request('POST',"https://localhost:44336/api/Shapes",[
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
            "ipdmobject", $ipdmobject
        ]);
    }
}