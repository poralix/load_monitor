#include <stdlib.h>
#include <stdio.h>
#include <libgen.h>
#include <unistd.h>
#include <pwd.h>
#include <sys/types.h>
#define USER "diradmin"
#define GROUP "diradmin"

int main (int argc, char **argv)
{
    int ret;
    uid_t ruid, s_ruid;
    gid_t rgid, s_rgid;
    char name[100];
    struct passwd *pw;

    ruid = getuid();
    rgid = getgid();
    pw = getpwuid(ruid);

    if (ruid == 0) {
        printf("[ERROR] You should not run this programm as %s (UID: %d)! Termninating...\n", pw->pw_name, ruid);
        return 0;
    }
    if (strcmp(pw->pw_name, USER) != 0) {
        printf("[ERROR] You are not allowed to run this programm as %s (UID: %d)! User %s is expected. Terminating...\n", pw->pw_name, ruid, USER);
        return 0;
    }
    setuid(0);
    setgid(0);

    char cmd[] = "/usr/local/directadmin/plugins/load_monitor/scripts/install_cron.sh";
    clearenv();
    execv(cmd, NULL);
}
