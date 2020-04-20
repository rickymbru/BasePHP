#!/usr/bin/python
import winrm    # pip install pywinrm
import sys
import secrets

hostname = secrets.hostname
username = secrets.username
password = secrets.password

nome=sys.argv[1]
usuario=sys.argv[2]
email=sys.argv[3]
manager=sys.argv[4]
givenname=sys.argv[5]
surname=sys.argv[6]
upn = usuario + "@cedae.corp"
grupo = "gsuite-basic"

s = winrm.Session(hostname, auth=(username,password),transport='ntlm')

ps_script1 = """$manager = (get-aduser """+manager+""" |select distinguishedname).distinguishedname
New-ADUser -Name \""""+nome+"""\" -SamAccountName """+usuario+""" -UserPrincipalName """+upn+""" `
-EmailAddress """+email+""" -Path "OU=INSTITUCIONAIS,OU=E-MAIL,DC=cedae,DC=corp" -ChangePasswordAtLogon $true -AccountPassword(ConvertTo-SecureString "cedae#4455" -AsPlainText -force) `
-Enabled $true -LogonWorkstations "DNS1,DNS2,DNS3" -company CEDAE -description Institucionais -Manager \"$manager\" -DisplayName \""""+nome+"""\" `
-GivenName \""""+givenname+"""\" -Surname \""""+surname+"""\"
Add-ADGroupMember -Identity """+grupo+""" -Members """+usuario

r = s.run_ps(ps_script1)
