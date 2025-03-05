document.getElementById('produto').addEventListener('change', function() {
    let preco = this.options[this.selectedIndex].getAttribute('data-preco');
    document.getElementById('preco').value = preco;
});
