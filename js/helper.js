function fetchhelper(url, httpMethod = 'get', contentType = 'application/json', data = {}) {
  let options = {
    method: httpMethod,
    headers: {
      'Content-Type': contentType
    }
  };
  if (httpMethod.toUpperCase() === 'POST') {
    options.body = JSON.stringify(data);
  }
  return new Promise((resolve, reject) => {
    fetch(url, options)
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then(responseData => {
        resolve(responseData);
      })
      .catch(error => {
        reject(error.message);
      });
  });
}
