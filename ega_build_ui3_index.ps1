$src = 'C:\Downloaded Web Sites\ega-babymart.mysapo.net\index.htm'
$dst = 'c:\xampp\htdocs\laravel-win-win-trai-cay-va-sua\resources\views\UI-FRONTEND3\index.blade.php'

$content = Get-Content -Raw -Encoding UTF8 $src

$baseTag = "<head>`n    <base href='{{ url('/') }}/UI-FRONTEND3/'>"

if ($content -match '<base\s') {
    Write-Host 'Index already has <base>. Skip inserting.'
} else {
    # Chèn <base> ngay sau thẻ <head> đầu tiên
    $content = $content -replace '<head>', $baseTag
}

Set-Content -Path $dst -Value $content -Encoding UTF8
Write-Host "Updated: $dst"

