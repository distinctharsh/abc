$pressDir = "c:\Users\disti\Desktop\tmc\public\images\press"
$files = Get-ChildItem -Path $pressDir -Filter "*.jpg" | Sort-Object Name

$counter = 1
foreach ($file in $files) {
    $newName = "p$counter.jpg"
    $newPath = Join-Path -Path $pressDir -ChildPath $newName
    
    # If the new name already exists, skip to prevent conflicts
    if (-not (Test-Path $newPath)) {
        Rename-Item -Path $file.FullName -NewName $newName
    }
    $counter++
}

Write-Host "Renamed $($files.Count) images in the press directory."
