## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Update
- 2026-11-21
    
    ```sql
    ALTER TABLE `loan__collaterals` ADD `extra2` VARCHAR(255) NULL DEFAULT NULL COMMENT 'for other' AFTER `type`; 
    ```

    ```sql
    ALTER TABLE `col_tmps` ADD `extra2` VARCHAR(255) NOT NULL AFTER `type`;
    ```