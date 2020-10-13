# cpp
A Cisco 79x1 and 79x2 config generator for FreePBX installations.

Ultra basic script to just generate hundreds of configs files for Cisco devices.
The devices must be first converted to SIP.

Just one page, that accepts a line by line config per device (on a csv format) and prints config files straight to the filesystem.
Then the files are copied to /tftpboot directory of the FreePBX to be available during provisioning.

In the templates folder two dummy files are included as reference.
