<script>
	var header = document.querySelector("header");
	var height = header.clientHeight;
	var windowHeight = window.innerHeight;
	var newHeight = `${windowHeight - height}px`;
	$('.banner-top').css('height', newHeight);
</script>
