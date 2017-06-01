

export RBENV_ROOT=/home/vagrant/.rbenv
export PATH=${RBENV_ROOT}/bin:$PATH
eval "$(rbenv init - zsh)"
alias mailcatcher='mailcatcher --http-ip 192.168.50.26'

alias dstat-full='dstat -Tclmdrn'
alias dstat-mem='dstat -Tclm'
alias dstat-cpu='dstat -Tclr'
alias dstat-net='dstat -Tclnd'
alias dstat-disk='dstat -Tcldr'
alias la='ls -la'
alias clear2="echo -e '\026\033c'"

alias psql56='psql -U pc8 -h 192.168.0.56 stonefree'
alias psql116='psql -U pc8 -h 192.168.0.116 stonefree'
alias psqlpro='psql -U pc8 -h buffalo.idc stonefree' 
