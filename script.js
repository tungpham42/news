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
function limitText(selector, maxLength) {
  const $element = $(selector);
  $element.each(function () {
    if ($(this).length) {
      let text = $(this).text();
      if (text.length > maxLength) {
        text = text.substring(0, maxLength) + "...";
        $(this).text(text);
      }
    }
  });
}
function stripHTMLTags(input) {
  return DOMPurify.sanitize(input, { ALLOWED_TAGS: [] });
}
function fetchRss(rssUrl, containerID, newsName) {
  $.ajax({
    url: "fetch_rss.php",
    data: {
      rssUrl: rssUrl,
    },
    method: "GET",
    success: function (data) {
      const newsContainer = $(containerID);
      newsContainer.empty();
      console.log(newsContainer);
      data.forEach(function (item, index) {
        var modalContainer = $("#newsModal-" + newsName + "-" + index);
        console.log("#newsModal-" + newsName + "-" + index);
        var modalBody = modalContainer.find(".modal-body");
        // modalBody.empty();
        const descriptionWithoutImg = item.description.replace(
          /<img[^>]*>/g,
          ""
        );

        newsContainer.append(`
                  <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title" title="${
                          item.title
                        }"><a href="${item.link}" target="_blank" data-bs-toggle="modal" data-bs-target="#newsModal-${newsName}-${index}">${item.title}</a></h5>
                        <p class="card-text">${stripHTMLTags(
                          descriptionWithoutImg
                        )}</p>
                        <small class="text-muted d-block my-3">${new Date(
                          item.pubDate
                        ).toLocaleDateString("vi-VN")}</small>
                      </div>
                    </div>
                  </div>
                `);
        $("body").append(`
          <div class="modal fade" id="newsModal-${newsName}-${index}" tabindex="-1" aria-labelledby="newsModalLabel-${newsName}-${index}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="newsModalLabel-${newsName}-${index}">${item.title}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                  <p>${item.description}<p>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-secondary" data-bs-dismiss="modal">Đóng</a>
                  <a class="btn btn-primary" target="_blank" href="${item.link}">Xem thêm</a>
                </div>
              </div>
            </div>
          </div>
        `);
      });
      limitText("h5.card-title > a", 50);
      limitText("p.card-text", 200);
    },
    error: function (err) {
      console.log("Error fetching RSS feed:", err);
    },
  });
}
newsData.forEach((news) => {
  fetchRss(news.url, "#" + news.name + "-news-container", news.name);
  $("#" + news.name + "-tab").on("click", function () {
    fetchRss(news.url, "#" + news.name + "-news-container", news.name);
  });
});
$(document).ready(function () {
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
  var btn = $("#back-to-top");

  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      btn.fadeIn();
    } else {
      btn.fadeOut();
    }
  });

  btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "300");
  });
});
