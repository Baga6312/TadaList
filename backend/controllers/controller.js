const axios = require('axios')

module.exports.saveToDo = async (req, res) => {
	const { text, _id } = req.body
	//TODO: send succefull message to the front 
	axios.post('http://localhost:8000/savetodo.php', { text, _id }).then((response) => {
		res.status(200).json(response.data)
	})
}

module.exports.getToDo = async (req, res) => {
	//TODO: send all todos to frontend as json

	axios.get('http://localhost:8000/gettodos.php').then((response) => {
		res.status(200).json(response.data)
	})
}

module.exports.updateToDo = async (req, res) => {
	const { _id, text } = req.body
	//TODO: update todo with id _id 
	//TODO: send to the front succefull update  
	axios.put('http://localhost:8000/updatetodo.php', { _id, text }).then((response) => {
		res.status(200).json(response.data)
	})
}

module.exports.deleteToDo = async (req, res) => {
	const { _id } = req.body
	//TODO: delete todo with id _id 
	// send to the front deletion succefull 
	axios.delete('http://localhost:8000/deletetodo.php', { _id }).then((response) => {
		res.status(200).json(response.data)
	})
}