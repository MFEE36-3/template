<!-- <nav aria-label="..." class="d-flex justify-content-center mt-3">
  <ul class="pagination pagination-lg" id="pagination-shop">
  </ul>
</nav> -->
<script>
  const renderPaginationLinks = (active, data, totalshow) => {
    const paginationLinks = [];

    for (let i = 1; i <= data.totalPages; i++) {
      const li_class = i == data.page ? "page-item active" : "page-item";
      const link =
        `<li class=${li_class}>
            <a class="page-link" href="http://localhost/template/kaishop.php?active=${active}&page=${i}&totalshow=${totalshow}">${i}
            </a>
        </li>`;
      paginationLinks.push(link);
    }

    let pagi = document.getElementById("pagination-shop");
    pagi.innerHTML = "";
    paginationLinks.forEach(pg_data => pagi.innerHTML += pg_data);
  };
  const renderPaginationLinks2 = (active, data, totalshow) => {
    const paginationLinks = [];
    for (let i = 1; i <= data.totalPages; i++) {
      const li_class = i == data.page ? "page-item active" : "page-item";
      const link =
        `<li class=${li_class}>
            <a class="page-link" href="http://localhost/template/kaishop.php?active=${active}&page=${i}&totalshow=${totalshow}">${i}
            </a>
        </li>`
      paginationLinks.push(link);
    }

    let pagi = document.getElementById("pagination-readyShop");
    pagi.innerHTML = "";
    paginationLinks.forEach(pg_data => pagi.innerHTML += pg_data);
  }

</script>