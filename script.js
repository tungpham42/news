function setEqualHeight(selector, offset = 0) {
  const elements = document.querySelectorAll(selector);
  let maxHeight = 0;

  elements.forEach((element) => {
    element.style.height = ""; // Reset height to recalculate properly
    const elementHeight = element.getBoundingClientRect().height;
    maxHeight = Math.max(maxHeight, elementHeight);
  });

  elements.forEach((element) => {
    element.style.height = maxHeight + offset + "px";
  });
}
function fetchRss(rssUrl, containerID) {
  $.ajax({
    url: "fetch_rss.php",
    data: {
      rssUrl: rssUrl,
    },
    method: "GET",
    success: function (data) {
      const newsContainer = $(containerID);
      newsContainer.empty();
      data.forEach(function (item) {
        // Remove img tags from the description
        const descriptionWithoutImg = item.description.replace(
          /<img[^>]*>/g,
          ""
        );

        newsContainer.append(`
                  <div class="col-md-4 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title"><a href="${
                          item.link
                        }" target="_blank">${item.title}</a></h5>
                        <p class="card-text">${descriptionWithoutImg}</p>
                        <small class="text-muted d-block my-3">${new Date(
                          item.pubDate
                        ).toLocaleDateString("vi-VN")}</small>
                      </div>
                    </div>
                  </div>
                `);
      });
    },
    error: function (err) {
      console.log("Error fetching RSS feed:", err);
    },
  });
}
$(document).ready(function () {
  newsData.forEach((news, index) => {
    fetchRss(news.url, "#" + news.name + "-news-container");
  });
  function updateHeights() {
    setEqualHeight("img.card-img-top");
    setEqualHeight("h5.card-title");
    setEqualHeight(".card-text");
  }
  function setEvents() {
    updateHeights();
    window.addEventListener("load", updateHeights);
    window.addEventListener("resize", updateHeights);
    $('button[data-bs-toggle="tab"]').on("shown.bs.tab", updateHeights);
    $(document).on("ajaxComplete", updateHeights);
  }
  setEvents();
});
