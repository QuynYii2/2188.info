<table class="table table-bordered">
    <thead class="thead-light">
    <tr>
        <th scope="col">Thumbnail</th>
        <th scope="col">Old Price</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Description</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <input type="file" id="thumbnail" class="img-cfg"
                   name="thumbnail1"
                   accept="image/*"
                   required>
        </td>
        <td>
            <input type="number"
                   class="value-check form-control" required
                   name="old_price1"
                   id="price1"
                   placeholder="Nhập giá bán">
        </td>
        <td>
            <input type="number"
                   class="value-check form-control"
                   name="price1" id="qty1"
                   placeholder="Nhập giá khuyến mãi">
        </td>
        <td>
            <input type="number"
                   class="value-check form-control" required
                   name="quantity1"
                   id="quantity1"
                   placeholder="Nhập quantity">
        </td>
        <td>
             <textarea class="form-control description"
                       name="description1"
                       rows="5"></textarea>
        </td>
    </tr>
    </tbody>
</table>
