// Listener for the Search Button
(function() {
    document.getElementById("search-button").addEventListener("click", function (e){
        e.preventDefault();
        // Get the IP address to search with
        var ip = document.getElementById('ip-entry').value;
        window.location.href = '/search/' + ip;
    })
})();
