export default 
(date) => {
    let day = date.getDay()
    let month = date.getMonth()
    let year = date.getFullYear()
    return day + "/" + month + "/" + year
  }