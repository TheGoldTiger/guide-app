export const getToken = (bearer = true) => {
    const token = localStorage.getItem('token')
    if (token) {
      return `${bearer ? 'Bearer ' : ''}${token}`
    }
  
    return null
  }
  