const axios = require('axios')

module.exports.saveToDo = async (req, res) => {
	const { text, _id } = req.body 
	axios.post('http://localhost:8000/savetodo.php', { text, _id }).then((response) => {
		res.status(200).json(response.data)
	})
}
module.exports.getToDo = async (req, res) => {
	axios.get('http://localhost:8000/gettodos.php').then((response) => {
		res.status(200).json(response.data)
	})
}
module.exports.updateToDo = async (req, res) => {
	const { _id, text } = req.body  
	axios.put('http://localhost:8000/updatetodo.php', { _id, text }).then((response) => {
		res.status(200).json(response.data)
	})
}
module.exports.deleteToDo = async (req, res) => {
	const { _id } = req.body
	axios.delete('http://localhost:8000/deletetodo.php', { _id }).then((response) => {
		res.status(200).json(response.data)
	})
}