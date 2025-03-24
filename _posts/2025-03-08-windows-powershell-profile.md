---
layout: post
title: Windows powershell profile
date: 2025-03-08 16:45:00
description: Windows powershell profile
tags: apan tech
categories: windows
featured: false
---
Windows powershell profile locates at:  
```powershell
C:\Users\$USER\Documents\WindowsPowerShell
```
The name of the file should be **Microsoft.PowerShell_profile.ps1**

Here is one example of this:  
```powershell
# BEFORE run this ps1 script, you need to run this as administrator
# Set-ExecutionPolicy Unrestricted
Set-PSReadLineKeyHandler -Chord Ctrl+l -Function ClearScreen
#New-Alias -Name cc -Value 'code.cmd'
New-Alias -Name ep -Value 'C:\Program Files\Just Great Software\EditPad Lite 8\EditPadLite8.exe'
New-Alias -Name hh -Value Get-History
New-Alias -Name ll -Value Get-ChildItem
New-Alias -Name n2 -Value 'D:\ap\opt\notepad2\Notepad2.exe'
New-Alias -Name nn -Value notepad.exe
New-Alias -Name pp -Value 'C:\Program Files\PuTTY\putty.exe'

#Save Command History
$HistoryPath = 'C:\Users\$USER\Documents\WindowsPowerShell\History'
If (Test-Path "${HistoryPath}\History.csv") {
    Import-Csv "${HistoryPath}\History.csv" | Add-History
    }  ElseIf (!(Test-Path $HistoryPath))  {
    New-Item -Path $HistoryPath -ItemType Directory
}
Register-EngineEvent -SourceIdentifier powershell.exiting -SupportEvent -Action {Get-History | Select-Object -Last 99999 | Export-Csv -Path "${HistoryPath}\History.csv"}

```
The part of save command history can make powershell having Linux history like command, very useful.  
You also need to make a directory **History** with **Microsoft.PowerShell_profile.ps1**, and a file **save_session_history.ps1**  
```powershell
#Save Command History
$HistoryPath = 'C:\Users\apan\Documents\WindowsPowerShell\History'
If (Test-Path "${HistoryPath}\History.csv") {
    Import-Csv "${HistoryPath}\History.csv" | Add-History
    }  ElseIf (!(Test-Path $HistoryPath))  {
    New-Item -Path $HistoryPath -ItemType Directory
}
Register-EngineEvent -SourceIdentifier powershell.exiting -SupportEvent -Action {Get-History | Select-Object -Last 99999 | Export-Csv -Path "${HistoryPath}\History.csv"}

```
