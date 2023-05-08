export default (axios, path = 'http://localhost/api') => ({
    signIn: async (data) => {
      return await axios.post(`${path}/login`, data)
    },
    me: async (token) => {
      return await axios.post(`${path}/me`, token)
    },
    checkAuthorization: async (token) => {
      return await axios.post(`${path}/authcheck`, token)
    }
  })
  