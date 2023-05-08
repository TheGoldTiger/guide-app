Noc vědců 2022
Endpointy



Users

GET /nocVedcu/api/index.php/user/getAllUsers

GET /nocVedcu/api/index.php/user/getUserByName?name=(string)

GET /nocVedcu/api/index.php/user/getAllWinners

POST /nocVedcu/api/index.php/user/changeUserMoney params: user=(int) money=(int)

POST /nocVedcu/api/index.php/user/addUser params: name=(string) return: Array("name" => "jméno s přidaným číslem", "token" => "token do local storage pro autorizaci")

POST /nocVedcu/api/index.php/user/removeUser params: id=(int)

POST /nocVedcu/api/index.php/user/setUserForVisibleInLeaderboards params: id=(int)




Questions

GET /nocVedcu/api/index.php/question/getQuestionForUser?user=(id)

POST /nocVedcu/api/index.php/question/sendAnswerForUser params: user=(int) user=(answer)