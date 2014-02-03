<form action="index.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $this->model->getId(); ?>" />
    <table>
        <tr><td>Data partenza</td><td><input type="text" class="datepicker" name="startDate" value="<?php echo $this->model->getStartDate(); ?>"</td></tr>
    </table>
    <button type="submit" name="op" value="modifyTransport">Salva</button>
</form>