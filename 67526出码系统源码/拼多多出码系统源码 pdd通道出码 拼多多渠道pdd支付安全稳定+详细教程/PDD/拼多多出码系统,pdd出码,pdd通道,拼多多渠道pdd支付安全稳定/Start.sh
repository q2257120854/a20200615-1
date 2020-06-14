#!/bin/bash
nohup bash OnPayFiveMinute.sh > /dev/null &
nohup bash OnPayOneMinute.sh > /dev/null &
nohup bash Received.sh > /dev/null &
nohup bash Notify.sh > /dev/null &