export default (axios, path = 'http://localhost/api') => ({
    getEventByCode: async ({code: code, id: id}) => {
      var time = new Date().getTime();
      return await axios.get(`${path}/getEventByCode?id=${id}&code=${code}&version=${time}`)
    },
  })
  