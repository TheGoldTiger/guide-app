/*
Základní soubor, který má na starosti api. 
Pomocí api komunikuje aplikace se serverem, kam ukládá data a nebo je z něj získává
*/
//Pro komunikaci se využívá axios, alternativa je ještě ajax, ale axios mi přijde lepší a zde seimportuje
import axios from 'axios'
//Import souboru s funkcemi ze souboru Data, která se týkají základní datové logiky

// import Auth from './auth'
import User from './player'
import Question from './question'
import Event from './event'


//Cesta, kam má api směřovat
var path = "http://localhost/nocvedcu/api/index.php";
// var pathAuth = path + "/auth";
var pathUser = path + '/player';
var pathQuestion = path + "/question";
var pathEvent = path + "/event";

export default {
  // auth: Auth(axios, pathAuth),
  user: User(axios, pathUser),
  question: Question(axios, pathQuestion),
  event: Event(axios, pathEvent)
}
