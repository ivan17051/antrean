<div class="modal fade" id="modal-qrcode" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pull-left">Cetak QR-Code</h5>
            </div>
            <div class="modal-body">
                <div class="imgblock text-center">
                    <div class="qr" id="qrcode"></div>
                    <h3 class="mt-2" id="qrcode_nik"></h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link">CETAK</button>
                <button type="button" class="btn btn-link" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>

@push('script')
<script type="text/javascript">
function createQRCode(nik){
    const qrconfig={
        text: nik,
        width: 240,
        height: 240,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.M,
    }
    document.getElementById("qrcode_nik").innerText = nik
    const container = document.getElementById("qrcode")
    container.innerHTML = ''
    new QRCode(container, qrconfig)
}

</script>
@endpush