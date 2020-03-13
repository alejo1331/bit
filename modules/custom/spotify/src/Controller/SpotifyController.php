<?php

namespace Drupal\spotify\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Routing\TrustedRedirectResponse;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenDialogCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\node\Entity\Node;

/**
 * Class SpotifyController.
 */
class SpotifyController extends ControllerBase {


  public function __construct() {

  }

    // Función que obtiene el listado de ultimos lanzamientos de spotify
    // Parametros: N/A
    public function content() {

        $respuesta = $this->get_token();
        $listLanzamientos = $this->get_lanzamientos($respuesta);
        $albumes = json_decode($listLanzamientos,true);
        
        return [
            '#theme' => 'resultados-lanzamientos',
            '#results' => $albumes,
            '#attached' => [
            'library' => [
                'spotify/spotify',
            ],
            ],
        ];

    }


    // Función que obtiene la información del artista
    // Parametros: id del artista
    public function infoartista($id) {
      $token = $this->get_token();
      $infoartista = $this->get_infoartista($token,$id);
      $infoBasicaArtista = json_decode($infoartista,true);

      $token2 = $this->get_token();
      $infoartistaalbum = $this->get_infoartistaalbum($token,$id);
      $album = json_decode($infoartistaalbum,true);
      var_dump($album);
      
      return [
          '#theme' => 'resultado-artista',
          '#infoBasicaArtista' => $infoBasicaArtista,
          '#album' => $album,
          '#info' => $infoartistaalbum,
          '#attached' => [
          'library' => [
              'spotify/spotify',
          ],
          ],
      ];
    }


    // Función que obtiene el token de spotify
    // Parametros: N/A
    // Return Array con resultado del token
    public function get_token() {

        $str = "7369f821cff24e6eaf428dfd200e9aec:91e17d6e739a42b2bf504b90bf33cb72";
        $credentialClientCode = "Basic ".base64_decode($str);
        try {
          //Instancia cliente http
          $client = \Drupal::httpClient();

          $url = "https://accounts.spotify.com/api/token";
          $method = 'POST';

          $options = ['form_params' => ['cache-control' => 'no-cache',
                                        'Authorization' => 'Basic  NzM2OWY4MjFjZmYyNGU2ZWFmNDI4ZGZkMjAwZTlhZWM6OTFlMTdkNmU3MzlhNDJiMmJmNTA0YjkwYmYzM2NiNzI=',
                                        'Content-Type' => 'application/x-www-form-urlencoded',
                                        'grant_type' => 'client_credentials',
                                        'client_id' => '7369f821cff24e6eaf428dfd200e9aec',
                                        'client_secret' => '91e17d6e739a42b2bf504b90bf33cb72'],
                      ];

            $response = $client->request($method, $url, $options);
            $code = $response->getStatusCode();
            if ($code == 200) {
                $resultado = $response->getBody()->getContents();
                return $resultado;
            }
        } catch (\Exception $e) {
            if (preg_match("/^Server error/", $e->getMessage())) {
              $respuesta = "No encontramos resultados para la búsqueda realizada, te recomendamos:<br> 1. Revisar los datos ingresados.<br> 2. Si aún no encuentras lo que buscas, por favor contactar a la entidad prestadora del servicio.";
            } else {

              $respuesta = "El servicio no se encuentra disponible en este momento, te recomendamos:<br> 1. Intentalo más tarde.<br> 2. Recarga la página.";
            }

            return $resultado;
        }
    }

    // Función que obtiene el listado de lanzamientos de spotify
    // Parametros: json con informaciónn del token
    // Return Array con el json de lanzamientos
    public function get_lanzamientos($infoToken) {

      $arraytoken = json_decode($infoToken);
      $token = "Bearer ".$arraytoken->access_token;

      try {
        //Instancia cliente http
        $client = \Drupal::httpClient();
        $url = "http://api.spotify.com/v1/browse/new-releases?country=CO";
        $method = 'GET';
        $options = [ 'headers' => ['cache-control' => 'no-cache',
                                    'Authorization' => $token,
                                  ],
                    ];

          $response = $client->request($method, $url, $options);
          $code = $response->getStatusCode();
          if ($code == 200) {
              $resultado = $response->getBody()->getContents();
              return $resultado;
          }
      } catch (\Exception $e) {
          if (preg_match("/^Server error/", $e->getMessage())) {
            $respuesta = "No encontramos resultados para la búsqueda realizada, te recomendamos:<br> 1. Revisar los datos ingresados.<br> 2. Si aún no encuentras lo que buscas, por favor contactar a la entidad prestadora del servicio.";
          } else {

            $respuesta = "El servicio no se encuentra disponible en este momento, te recomendamos:<br> 1. Intentalo más tarde.<br> 2. Recarga la página.";
          }

          return $respuesta;
      }
    }

    // Función que obtiene la información del artista por el id
    // Parametros: json con informaciónn del token, id de artista
    // Return Array con el json de lanzamientos
    public function get_infoartista($infoToken, $id) {

      $arraytoken = json_decode($infoToken);
      $token = "Bearer ".$arraytoken->access_token;

      try {
        //Instancia cliente http
        $client = \Drupal::httpClient();
        $url = "https://api.spotify.com/v1/artists/".$id;
        $method = 'GET';
        $options = [ 'headers' => ['cache-control' => 'no-cache',
                                    'Authorization' => $token,
                                  ],
                    ];

          $response = $client->request($method, $url, $options);
          $code = $response->getStatusCode();
          if ($code == 200) {
              $resultado = $response->getBody()->getContents();
              return $resultado;
          }
      } catch (\Exception $e) {
          if (preg_match("/^Server error/", $e->getMessage())) {
            $respuesta = "No encontramos resultados para la búsqueda realizada, te recomendamos:<br> 1. Revisar los datos ingresados.<br> 2. Si aún no encuentras lo que buscas, por favor contactar a la entidad prestadora del servicio.";
          } else {

            $respuesta = "El servicio no se encuentra disponible en este momento, te recomendamos:<br> 1. Intentalo más tarde.<br> 2. Recarga la página.";
          }

          return $respuesta;
      }
    }


    // Función que obtiene la información del album del artista
    // Parametros: json con informaciónn del token, id de artista
    // Return Array con el json de lanzamientos
    public function get_infoartistaalbum($infoToken, $id) {

      $arraytoken = json_decode($infoToken);
      $token = "Bearer ".$arraytoken->access_token;

      try {
        //Instancia cliente http
        $client = \Drupal::httpClient();
        https://api.spotify.com/v1/artists/{id}/top-tracks
        $url = "https://api.spotify.com/v1/artists/".$id."/top-tracks?country=CO";
        $method = 'GET';
        $options = [ 'headers' => ['cache-control' => 'no-cache',
                                    'Authorization' => $token,
                                  ],
                    ];

          $response = $client->request($method, $url, $options);
          $code = $response->getStatusCode();
          if ($code == 200) {
              $resultado = $response->getBody()->getContents();
              return $resultado;
          }
      } catch (\Exception $e) {
          if (preg_match("/^Server error/", $e->getMessage())) {
            $respuesta = "No encontramos resultados para la búsqueda realizada, te recomendamos:<br> 1. Revisar los datos ingresados.<br> 2. Si aún no encuentras lo que buscas, por favor contactar a la entidad prestadora del servicio.";
          } else {

            $respuesta = "El servicio no se encuentra disponible en este momento, te recomendamos:<br> 1. Intentalo más tarde.<br> 2. Recarga la página.";
          }

          return $respuesta;
      }
    }


  function twig_json_decode($json)
  {
      return json_decode($json, true);
  }
}