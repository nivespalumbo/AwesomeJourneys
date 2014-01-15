<form action="index.php" method="GET">
    <label>Luogo</label><input type="text" name="location" />
    <label>Data partenza</label><input type="date" name="startDate" class="datepicker"/>
    <button type="submit" name="op" value="search">Cerca</button>
</form>

<script type="text/javascript">
    $(".datepicker").datepicker();
</script>