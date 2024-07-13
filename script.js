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
  const elements = $(selector);
  elements.each(function () {
    const text = $(this).text();
    if (text.length > maxLength) {
      $(this).text(text.substring(0, maxLength) + "...");
    }
  });
}

function stripHTMLTags(input) {
  return DOMPurify.sanitize(input, { ALLOWED_TAGS: [] });
}

const newsModal = document.getElementById("newsModal");
const newsModalLabel = document.getElementById("newsModalLabel");
const newsModalBody = document.getElementById("newsModalBody");
const newsModalLink = document.getElementById("newsModalLink");

function fetchRss(rssUrl, newsName) {
  $.ajax({
    url: "fetch_rss.php",
    data: { rssUrl },
    dataType: "json",
    method: "GET",
    success: function (data) {
      const newsContainer = $(`#${newsName}-news-container`);
      newsContainer.empty();

      data.forEach((item) => {
        const descriptionWithoutImg = item.description.replace(
          /<img[^>]*>/g,
          ""
        );
        newsContainer.append(`
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card" data-bs-toggle="modal" data-bs-target="#newsModal">
              <div class="card-body">
                <h5 class="card-title" title="${item.title}">${item.title}</h5>
                <p class="card-text">${stripHTMLTags(descriptionWithoutImg)}</p>
                <div class="card-description d-none">${item.content}</div>
                <span class="card-title-full d-none">${item.title}</span>
                <span class="card-link d-none">${item.link}</span>
                <small class="text-muted d-block my-3">${new Date(
                  item.pubDate
                ).toLocaleDateString("vi-VN")}</small>
              </div>
            </div>
          </div>
        `);
      });

      limitText("h5.card-title", 50);
      limitText("p.card-text", 200);
    },
    error: function (err) {
      console.error("Error fetching RSS feed:", err);
    },
  });
}

newsModal.addEventListener("hide.bs.modal", () => {
  newsModalLabel.textContent = "";
  newsModalBody.innerHTML = "";
  newsModalLink.setAttribute("href", "");
});

newsModal.addEventListener("show.bs.modal", (event) => {
  const relatedTarget = event.relatedTarget;
  newsModalLabel.textContent =
    relatedTarget.querySelector(".card-title-full").textContent;
  newsModalBody.innerHTML =
    relatedTarget.querySelector(".card-description").innerHTML;
  newsModalLink.setAttribute(
    "href",
    relatedTarget.querySelector(".card-link").textContent
  );
});

newsData.forEach((news) => {
  fetchRss(news.url, news.name);
  $(`#${news.name}-tab`).on("click", () => {
    fetchRss(news.url, news.name);
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

  const topBtn = $("#back-to-top");
  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      topBtn.fadeIn();
    } else {
      topBtn.fadeOut();
    }
  });

  topBtn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "300");
  });
});
