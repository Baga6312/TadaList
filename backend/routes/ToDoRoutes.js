const {Router} = require("express")
const { saveToDo, getToDo, updateToDo, deleteToDo } = require("../controllers/controller")


//contructing the router 
const router = Router() 

router.get('/', getToDo)

router.post('/',saveToDo)

router.put('/' , updateToDo)

router.delete('/' , deleteToDo)

module.exports = router 
