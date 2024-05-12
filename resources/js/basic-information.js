import $ from 'jquery';
window.searchKeywords = (search, callback) => {
  if (!search || search.length < 3) {
    callback([]);
    return;
  }
  $.ajax({
    url: `/keywords/${search}`,
    method: 'GET',
    cache: false,
    success: (result) => {
      callback(result);
    },
    error: (error) => {
      console.log(error);
    }
  });
}