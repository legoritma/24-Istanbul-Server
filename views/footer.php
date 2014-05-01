          <!-- FOOTER -->
        <div class="container marketing">
            <footer>
                <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; 2014 24Istanbul, Inc. &middot;</p>
            </footer>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/assets/js/bootstrap.min.js"></script>
        <?php
        if (isset($footerExtra)) {
            foreach ($footerExtra as $extra) {
                include $extra;
            }
        }
        ?>
    </body>
</html>