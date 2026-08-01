<div class="pagination-wrapper">
    <span class="total-pagination-pages">
        <?= $totalPages != 0 ? $currentPage : 0; ?> / <?= $totalPages ?>
    </span>

    <ul class="pagination">
        <?php if ($currentPage > 1): ?>
            <li><a href="?page=<?= $currentPage - 1 ?>">Previous</a></li>
        <?php else: ?>
            <li class="disable-btn">
                <a href="?page=<?= $currentPage - 1 ?>">Previous</a>
            </li>
        <?php endif; ?>

        <?php for ($page = 1; $page <= $totalPages; $page++): ?>
            <li class="<?= ($page === $currentPage) ? 'page-active' : '' ?>">
                <a href="?page=<?= $page ?>"><?= $page ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <li><a href="?page=<?= $currentPage + 1 ?>">Next</a></li>
        <?php else: ?>
            <li class="disable-btn">
                <a href="?page=<?= $currentPage + 1 ?>">Next</a>
            </li>
        <?php endif; ?>
    </ul>
</div>