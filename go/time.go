package main

import (
    "fmt"
    "time"
)

func main() {
    now := time.Now()
    lastMonth := now.AddDate(0, -1, 0)
    fmt.Println(lastMonth.Format("2006-01-02"))
}