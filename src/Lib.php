<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2013 - 2022
 * @package yii2-helpers
 * @version 1.4.0
 */

namespace kartik\base;

/**
 * Lib is a base class for modified standard PHP internal functions. It is specifically built to address warnings in
 * PHP v8.1 and above due to null arguments passed to PHP internal functions which results in deprecation errors in PHP
 * v8.1 and beyond.
 *
 * Usage:
 *
 *```php
 * use kartik\helpers\Lib;
 *
 * // examples of usage
 * echo Lib::trim(' String ');
 *```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 *
 */
class Lib
{
    /**
     * Return part of a string.
     *
     * @link https://php.net/manual/en/function.substr.php
     *
     * @param  string|null  $string  The input string.
     * @param  int  $offset  The starting offset position.
     * - If the start is non-negative, the returned string will start at the start'th position in
     * string, counting from zero. For instance, in the string 'abcdef', the character at position `0` is 'a', the
     * character at position `2` is 'c', and so forth.
     * - If start is negative, the returned string will start at the start'th character from the end of string.
     * - If string is less than or equal to start characters long, `false` will be returned.
     *
     * Example(s) of using a negative start:
     *
     * ```php
     * $rest = Lib::substr("abcdef", -1);    // returns "f"
     * $rest = Lib::substr("abcdef", -2);    // returns "ef"
     * $rest = Lib::substr("abcdef", -3, 1); // returns "d"
     * ```
     *
     * @param  int|null  $length  The length of characters to return.
     * - If length is given and is positive, the string returned will contain at most length characters beginning
     * from start (depending on the length of string).
     * - If length is given and is negative, then that many characters will be omitted from the end of string (after
     * the start position has been calculated when a start is negative). If start denotes a position beyond this
     * truncation, an empty _string_ will be returned.
     * - If length is given and is `0`, then `false` or `null` or an empty _string_ will be returned.
     *
     * Example(s) of using a negative length:
     *
     * ```php
     * $rest = Lib::substr("abcdef", 0, -1);  // returns "abcde"
     * $rest = Lib::substr("abcdef", 2, -1);  // returns "cde"
     * $rest = Lib::substr("abcdef", 4, -4);  // returns false
     * $rest = Lib::substr("abcdef", -3, -1); // returns "de"
     * ```
     *
     * @return string|false the extracted part of string or false on failure.
     */
    public static function substr($string, $offset, $length = null)
    {
        if (!isset($string)) {
            return '';
        }
        $string = (string)$string;

        return isset($length) ? substr($string, $offset, $length) : substr($string, $offset);
    }

    /**
     * Binary safe string comparison of the first n characters
     *
     * @link https://php.net/manual/en/function.strncmp.php
     *
     * @param  string  $string1  The first string.
     * @param  string  $string2  The second string.
     * @param  int  $length  Number of characters to use in the comparison.
     *
     * @return int `< 0` if `str1` is less than `str2`, `> 0` if `str1` is greater than `str2`, and `= 0` if they are
     * equal.
     */
    public static function strncmp($string1, $string2, $length)
    {
        $string1 = isset($string1) ? (string)$string1 : '';
        $string2 = isset($string2) ? (string)$string2 : '';

        return strncmp($string1, $string2, $length);
    }

    /**
     * Split a string by a string.
     *
     * @link https://php.net/manual/en/function.explode.php
     *
     * @param  string  $separator  The boundary string.
     * @param  string  $string  The input string.
     * @param  int|null  $limit  If limit is set and positive, the returned _array_ will contain a maximum of
     * limit elements with the last element containing the rest of string. If the limit parameter is negative, all
     * components except the last -limit are returned. If the limit parameter is zero, then this is treated as `1`.
     *
     * @return string[]|false If delimiter is an empty _string_ (`""`), explode will return false. If delimiter contains a
     * value that is not contained in string and a negative limit is used, then an empty _array_ will be returned.
     * For any other limit, an _array_ containing string will be returned.
     */
    public static function explode($separator, $string, $limit = null)
    {
        if (!isset($string) || !isset($separator)) {
            return [];
        }
        $separator = (string)$separator;
        $string = (string)$string;

        return isset($limit) ? explode($separator, $string, $limit) : explode($separator, $string);
    }

    /**
     * Strip whitespace (or other characters) from the beginning and end of a string.
     *
     * @link https://php.net/manual/en/function.trim.php
     *
     * Example:
     *
     * ```php
     * $trimmed = Lib::trim($string);
     * ```
     *
     * @param  string|null  $string  The string that will be trimmed.
     * @param  string  $characters  Optionally, the stripped characters can also be specified using the charlist
     * parameter. Simply list all characters that you want to be stripped. With `..` you can specify a range of
     * characters.
     *
     * @return string The trimmed string.
     */
    public static function trim($string, $characters = null)
    {
        return isset($string) ? (isset($characters) ? trim((string)$string, $characters) : trim((string)$string)) : '';
    }

    /**
     * Make a string lowercase.
     *
     * @link https://php.net/manual/en/function.strtolower.php
     *
     * Example:
     *
     * ```php
     * $lower = Lib::strtolower($string);
     * ```
     *
     * @param  string|null  $string  The input string.
     *
     * @return string the lowercased string.
     */
    public static function strtolower($string)
    {
        return isset($string) ? strtolower((string)$string) : '';
    }

    /**
     * Make a string uppercase.
     *
     * @link https://php.net/manual/en/function.strtoupper.php
     *
     * Example:
     *
     * ```php
     * $upper = Lib::strtoupper($string);
     * ```
     *
     * @param  string|null  $string  The input string.
     *
     * @return string the uppercased string.
     */
    public static function strtoupper($string)
    {
        return isset($string) ? strtoupper((string)$string) : '';
    }

    /**
     * Get string length.
     *
     * @link https://php.net/manual/en/function.strlen.php
     *
     * Example:
     *
     * ```php
     * if (Lib::strlen($string) > 0) {
     *    // do something
     * }
     * ```
     *
     * @param  string  $string  The string being measured for length.
     *
     * @return int The length of the _string_ on success, and `0` if the _string_ is empty.
     */
    public static function strlen($string)
    {
        return isset($string) ? strlen((string)$string) : 0;
    }

    /**
     * Repeat a string.
     *
     * @link https://php.net/manual/en/function.str-repeat.php
     *
     * @param  string  $string  The string to be repeated.
     * @param  int|null  $times  Number of time the input string should be repeated. The multiplier has to be greater than
     * or equal to `0`. If the multiplier is set to `0`, the function will return an empty _string_.
     *
     * @return string the repeated string.
     */
    public static function str_repeat($string, $times = null)
    {
        if (empty($times) || $times < 0) {
            $times = 0;
        }

        return isset($string) ? str_repeat((string)$string, $times) : '';
    }

    /**
     * Find the position of the first occurrence of a substring in a string.
     *
     * @link https://php.net/manual/en/function.strpos.php
     *
     * @param  string  $haystack  The string to search in
     * @param  string  $needle  If `needle` is not a _string_, it is converted to an _integer_ and applied as the ordinal
     * value of a character.
     * @param  int  $offset  If specified, search will start this number of characters counted from the
     * beginning of the string. Unlike [[strrpos()]] and [[stripos()]], the offset cannot be negative.
     *
     * @return int|false Returns the position where the `needle` exists relative to the beginning of the `haystack `
     * string (independent of search direction or offset). Also note that string positions start at `0`, and not `1`.
     * Returns `FALSE` if the `needle` was not found.
     */
    public static function strpos($haystack, $needle, $offset = 0)
    {
        $offset = empty($offset) || !is_numeric($offset) ? 0 : (int)$offset;

        return isset($haystack) && isset($needle) ? strpos((string)$haystack, (string)$needle, $offset) : false;
    }

    /**
     * Find position of last occurrence of a case-insensitive string in a string
     *
     * @link https://php.net/manual/en/function.strrpos.php
     *
     * @param  string  $haystack  The string to search in
     * @param  string  $needle  If `needle` is not a _string_, it is converted to an _integer_ and applied as the ordinal
     * value of a character.
     * @param  int  $offset  If specified, search will start this number of characters counted from the
     * beginning of the string. If the value is negative, search will instead start from that many characters from
     * the end of the string, searching backwards.
     *
     * @return int|false Returns the position where the `needle` exists relative to the beginning of the `haystack `
     * string (independent of search direction or offset). Also note that string positions start at `0`, and not `1`.
     * Returns `FALSE` if the `needle` was not found.
     */
    public static function stripos($haystack, $needle, $offset = 0)
    {
        $offset = empty($offset) || !is_numeric($offset) ? 0 : (int)$offset;

        return isset($haystack) && isset($needle) ? stripos((string)$haystack, (string)$needle, $offset) : false;
    }

    /**
     * Find the position of the last occurrence of a substring in a string
     *
     * @link https://php.net/manual/en/function.strrpos.php
     *
     * @param  string  $haystack  The string to search in
     * @param  string  $needle  If `needle` is not a _string_, it is converted to an _integer_ and applied as the ordinal
     * value of a character.
     * @param  int  $offset  If specified, search will start this number of characters counted from the beginning of the
     * string. If the value is negative, search will instead start from that many characters from the end of the string, searching backwards.
     *
     * @return int|false Returns the position where the `needle` exists relative to the beginning of the `haystack `
     * string (independent of search direction or offset). Also note that string positions start at `0`, and not `1`.
     * Returns `FALSE` if the `needle` was not found.
     */
    public static function strrpos($haystack, $needle, $offset = 0)
    {
        $offset = empty($offset) || !is_numeric($offset) ? 0 : (int)$offset;

        return isset($haystack) && isset($needle) ? strrpos((string)$haystack, (string)$needle, $offset) : false;
    }

    /**
     * Replace all occurrences of the search string with the replacement string.
     *
     * @link https://php.net/manual/en/function.str-replace.php
     *
     * Example:
     *
     * ```php
     * $replaced = Lib::str_replace('ell', '-', 'Hello');
     * ```
     *
     * @param  string|string[]  $search  The value being searched for, otherwise known as the `needle`. An _array_ may be
     * used to designate multiple `needles`.
     * @param  string|string[]  $replace  The replacement value that replaces found search values. An _array_ may be used
     * to designate multiple replacements.
     * @param  string|string[]  $subject  The _string_ or _array_ being searched and replaced on, otherwise known as the
     * `haystack`. If `subject` is an _array_, then the search and replace is performed with every entry of `subject`, and
     * the return value is an _array_ as well.
     * @param  int  $count  If passed, this will hold the number of matched and replaced `needles`.
     *
     * @return string|string[] This function returns a _string_ or an _array_ with the replaced values.
     */
    public static function str_replace($search, $replace, $subject, &$count = null)
    {
        if (!isset($subject)) {
            return '';
        }
        if (!isset($search)) {
            return $subject;
        }
        if (!isset($replace)) {
            $replace = '';
        }

        return str_replace($search, $replace, $subject, $count);
    }

    /**
     * Case-insensitive version of [[str_replace]].
     *
     * @link https://php.net/manual/en/function.str-replace.php
     *
     * Example:
     *
     * ```php
     * $replaced = Lib::str_replace('ell', '-', 'Hello');
     * ```
     *
     * @param  string|string[]  $search  The value being searched for, otherwise known as the `needle`. An _array_ may be
     * used to designate multiple `needles`.
     * @param  string|string[]  $replace  The replacement value that replaces found search values. An _array_ may be used
     * to designate multiple `replacements`.
     * @param  string|string[]  $subject  The _string_ or _array_ being searched and replaced on, otherwise known as the
     * `haystack`. If `subject` is an _array_, then the search and replace is performed with every entry of `subject`, and
     * the return value is an _array_ as well.
     * @param  int  $count  If passed, this will hold the number of matched and replaced `needles`.
     *
     * @return string|string[] This function returns a _string_ or an _array_ with the replaced values.
     */
    public static function str_ireplace($search, $replace, $subject, &$count = null)
    {
        if (!isset($subject)) {
            return '';
        }
        if (!isset($search)) {
            return $subject;
        }
        if (!isset($replace)) {
            $replace = '';
        }

        return str_ireplace($search, $replace, $subject, $count);
    }

    /**
     * Translate certain characters.
     *
     * @link https://php.net/manual/en/function.strtr.php
     *
     * Example:
     *
     * ```php
     * $replaced = Lib::strtr('Hello World!', ['o' => 'a', 'l' => 'r']);
     * ```
     *
     * @param  string  $string  The string being translated.
     * @param  array  $replace_pairs  The replace_pairs parameter may be used as a substitute for to and from in which
     * case it's an _array_ in the form `['from' => 'to', ...]`.
     *
     * @return string A copy of str, translating all occurrences of each character in `from` to the corresponding
     * character in `to`.
     */
    public static function strtr($string, $replace_pairs = [])
    {
        return isset($string) ? strtr((string)$string, $replace_pairs) : '';
    }


    /**
     * URL-encodes string.
     *
     * @link https://php.net/manual/en/function.urlencode.php
     *
     * @param  string  $string  The string to be encoded.
     *
     * @return string a string in which all non-alphanumeric characters except `'*'`,`' '`,`'-'`,`'_'`,`'.'` have been replaced with a
     * percent (`%`) sign followed by two hex digits and spaces encoded as plus (`+`) signs. It is encoded the same way
     * that the posted data from a WWW form is encoded, that is the same way as in application/x-www-form-urlencoded
     * media type. This differs from the RFC 3986 encoding (see [[rawurlencode()]]) in that for historical reasons, spaces
     * are encoded as plus (`+`) signs.
     */
    public static function urlencode($string)
    {
        return isset($string) ? urlencode((string)$string) : '';
    }

    /**
     * Decodes URL-encoded string
     *
     * @link https://php.net/manual/en/function.urldecode.php
     *
     * @param  string  $string  The string to be decoded.
     *
     * @return string the decoded string.
     */
    public static function urldecode($string)
    {
        return isset($string) ? urldecode((string)$string) : '';
    }

    /**
     * URL-encode according to RFC 3986
     *
     * @link https://php.net/manual/en/function.rawurlencode.php
     *
     * @param  string  $string  The string to be encoded.
     *
     * @return string a string in which all non-alphanumeric characters except -_. have been replaced with a percent
     * (`%`) sign followed by two hex digits. This is the encoding described in RFC 1738 for protecting literal
     * characters from being interpreted as special URL delimiters, and for protecting URLs from being mangled by
     * transmission media with character conversions (like some email systems).
     */
    public static function rawurlencode($string)
    {
        return isset($string) ? rawurlencode((string)$string) : '';
    }

    /**
     * Decode URL-encoded strings
     *
     * @link https://php.net/manual/en/function.rawurldecode.php
     *
     * @param  string  $string  The URL to be encoded.
     *
     * @return string the decoded URL, as a string.
     */
    public static function rawurldecode($string)
    {
        return isset($string) ? rawurldecode((string)$string) : '';
    }

    /**
     * Make a string's first character lowercase
     *
     * @link https://php.net/manual/en/function.lcfirst.php
     *
     * @param  string  $string  The input string.
     *
     * @return string the resulting string.
     */
    public static function lcfirst($string)
    {
        return isset($string) ? lcfirst((string)$string) : '';
    }

    /**
     * Make a string's first character uppercase
     *
     * @link https://php.net/manual/en/function.ucfirst.php
     *
     * @param  string  $string  The input string.
     *
     * @return string the resulting string.
     */
    public static function ucfirst($string)
    {
        return isset($string) ? ucfirst((string)$string) : '';
    }

    /**
     * Uppercase the first character of each word in a string
     *
     * @link https://php.net/manual/en/function.ucwords.php
     *
     * @param  string  $string  The input string.
     * @param  string  $separators  The optional separators contains the word separator characters.
     *
     * @return string the modified string.
     */
    public static function ucwords($string, $separators = " \t\r\n\f\v")
    {
        return isset($string) ? ucwords((string)$string, $separators) : '';
    }

    /**
     * Inserts HTML line breaks before all newlines in a string
     *
     * @link https://php.net/manual/en/function.nl2br.php
     *
     * @param  string  $string  The input string.
     * @param  bool  $use_xhtml  Whenever to use XHTML compatible line breaks or not.
     *
     * @return string the altered string.
     */
    public static function nl2br($string, $use_xhtml = true)
    {
        return isset($string) ? nl2br((string)$string, $use_xhtml) : '';
    }

    /**
     * Strip HTML and PHP tags from a string
     *
     * @link https://php.net/manual/en/function.strip-tags.php
     *
     * @param  string  $string  The input string.
     * @param  string[]|string|null  $allowed_tags  You can use the optional second parameter to specify
     * tags which should not be stripped. HTML comments and PHP tags are also stripped. This is hardcoded and can
     * not be changed with allowable_tags.
     *
     * @return string the stripped string.
     */
    public static function strip_tags($string, $allowed_tags = null)
    {
        return isset($string) ? strip_tags((string)$string, $allowed_tags) : '';
    }

    /**
     * Convert HTML entities  to their corresponding characters.
     *
     * @link https://php.net/manual/en/function.html-entity-decode.php
     *
     * @param  string  $string  The input string.
     * @param  int  $flags  The optional second quote_style parameter lets you define what will be done with
     * 'single' and "double" quotes. It takes on one of three constants with the default being `ENT_COMPAT `.
     * Available quote_style constants:
     * - `ENT_COMPAT`: Will convert double-quotes and leave single-quotes alone.
     * - `ENT_QUOTES`: Will convert both double and single quotes.
     * - `ENT_NOQUOTES`: Will leave both double and single quotes unconverted.
     * @param  string|null  $encoding  The ISO-8859-1 character set is used as default for the optional
     * third
     * charset. This defines the character set used in conversion.
     *
     * @return string the decoded string.
     */
    public static function html_entity_decode($string, $flags = ENT_COMPAT, $encoding = null)
    {
        return isset($string) ? html_entity_decode((string)$string, $flags, $encoding) : '';
    }

    /**
     * Perform a regular expression match
     *
     * @link https://php.net/manual/en/function.preg-match.php
     *
     * @param  string  $pattern  The pattern to search for, as a string.
     * @param  string  $subject  The input string.
     * @param  string[]  $matches  If `matches` is provided, then it is filled with the results of search.
     * $matches[0] will contain the text that matched the full pattern, $matches[1] will have the text that matched
     * the first captured parenthesized subpattern, and so on.
     * @param  int  $flags  _flags_ can be the following flags:
     * - `PREG_OFFSET_CAPTURE`: If this flag is passed, for every occurring match the appendant string offset will
     * also be returned. Note that this changes the value of `matches` into an _array_ where every element is an
     * _array_ consisting of the matched string at offset `0` and its string offset into `subject` at offset `1`.
     *
     * ```php
     * Lib::preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
     * print_r($matches);
     * ```
     *
     * The above example will output:
     *
     * ~~~
     * Array
     * (
     *   [0] => Array
     *     (
     *       [0] => foobarbaz
     *       [1] => 0
     *     )
     *
     *   [1] => Array
     *     (
     *         [0] => foo
     *         [1] => 0
     *     )
     *
     *   [2] => Array
     *     (
     *         [0] => bar
     *         [1] => 3
     *     )
     *
     *   [3] => Array
     *     (
     *         [0] => baz
     *         [1] => 6
     *     )
     * )
     * ~~~
     *
     * - `PREG_UNMATCHED_AS_NULL `: If this flag is passed, unmatched subpatterns are reported as NULL; otherwise they
     * are reported as an empty _string_.
     *
     * ```php
     * Lib::preg_match('/(a)(b)*(c)/', 'ac', $matches);
     * var_dump($matches);
     * Lib::preg_match('/(a)(b)*(c)/', 'ac', $matches, PREG_UNMATCHED_AS_NULL);
     * var_dump($matches);
     * ```
     *
     * The above example will output:
     *
     * ~~~
     * array(4) {
     *   [0]=> string(2) "ac"
     *   [1]=> string(1) "a"
     *   [2]=> string(0) ""
     *   [3]=> string(1) "c"
     * }
     * array(4) {
     *   [0]=> string(2) "ac"
     *   [1]=> string(1) "a"
     *   [2]=> NULL
     *   [3]=> string(1) "c"
     * }
     * ~~~
     *
     * @param  int  $offset  Normally, the search starts from the beginning of the `subject` string. The
     * optional parameter `offset` can be used to specify the alternate place from which to start the search (in
     * bytes). Using `offset` is not equivalent to passing substr($subject, $offset) to `preg_match` in place of
     * the `subject` string, because `pattern` can contain assertions such as `^`, `$` or `(?<=x)`.
     *
     * Compare:
     *
     * ```php
     * $subject = "abcdef";
     * $pattern = '/^def/';
     * Lib::preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE, 3);
     * print_r($matches);
     * ```
     *
     * The above example will output:
     *
     * ~~~
     * Array
     * (
     * )
     * ~~~
     *
     * while this example
     *
     * ```php
     * $subject = "abcdef";
     * $pattern = '/^def/';
     * Lib::preg_match($pattern, substr($subject,3), $matches, PREG_OFFSET_CAPTURE);
     * print_r($matches);
     * ```
     *
     * will produce:
     *
     * ~~~
     * Array
     * (
     * [0] => Array
     *     (
     *         [0] => def
     *         [1] => 0
     *     )
     * )
     * ~~~
     *
     * Alternatively, to avoid using `substr()`, use the `\G` assertion rather than the `^` anchor, or the `A` modifier
     * instead, both of which work with the offset parameter.
     *
     * @return int|false `preg_match` returns `1` if the `pattern` matches given `subject `, `0` if it does not, or
     * `FALSE` if an error occurred.
     */
    public static function preg_match($pattern, $subject, &$matches, $flags = 0, $offset = 0)
    {
        if (!isset($pattern) || !isset($subject)) {
            return 0;
        }

        return preg_match((string)$pattern, (string)$subject, $matches, $flags, $offset);
    }

    /**
     * Perform a global regular expression match.
     *
     * @link https://php.net/manual/en/function.preg-match-all.php
     *
     * @param  string  $pattern  The pattern to search for, as a _string_.
     * @param  string  $subject  The input _string_.
     * @param  string[][]  $matches  _Array_ of all matches in multi-dimensional _array_ ordered according to flags.
     * @param  int  $flags  Can be a combination of the following flags (note that it doesn't make sense to
     * use `PREG_PATTERN_ORDER` together with `PREG_SET_ORDER`):
     * - `PREG_PATTERN_ORDER`: Orders results so that `$matches[0]` is an _array_ of full pattern matches, `$matches[1]`
     * is an _array_ of strings matched by the first parenthesized subpattern, and so on. For example:
     *
     * ```php
     * preg_match_all(
     *     "|<[^>]+>(.*)</[^>]+>|U",
     *     "<b>example: </b><div align=left>this is a test</div>",
     *     $out, PREG_PATTERN_ORDER
     * );
     * echo $out[0][0] . ", " . $out[0][1] . "\n";
     * echo $out[1][0] . ", " . $out[1][1] . "\n";
     * ```
     *
     * The above example will output:
     *
     * ~~~
     * <b>example: </b>, <div align=left>this is a test</div>
     * example: , this is a test
     * ~~~
     *
     * So, `$out[0]` contains _array_ of _strings_ that matched full pattern, and `$out[1]` contains _array_ of _strings_
     * enclosed by tags.
     *
     * If the pattern contains named subpatterns, $matches additionally contains entries for keys with the subpattern
     * name.
     *
     * If the pattern contains duplicate named subpatterns, only the rightmost subpattern is stored in `$matches[NAME]`.
     *
     * ```php
     * preg_match_all(
     *     '/(?J)(?<match>foo)|(?<match>bar)/',
     *     'foo bar',
     *     $matches,
     *     PREG_PATTERN_ORDER
     * );
     * print_r($matches['match'])
     * ```
     *
     * The above example will output:
     *
     * ~~~
     * Array
     * (
     *     [0] =>
     *     [1] => bar
     * )
     * ~~~
     *
     * - `PREG_SET_ORDER`: Orders results so that `$matches[0]` is an _array_ of first set of matches, `$matches[1]`
     * is an _array_ of second set of matches, and so on. For example:
     *
     * ```php
     * preg_match_all(
     *     "|<[^>]+>(.*)</[^>]+>|U",
     *     "<b>example: </b><div align=left>this is a test</div>",
     *     $out, PREG_SET_ORDER
     * );
     * echo $out[0][0] . ", " . $out[0][1] . "\n";
     * echo $out[1][0] . ", " . $out[1][1] . "\n";
     * ```
     *
     * The above example will output
     *
     * ~~~
     * <b>example: </b>, example:
     * <div align="left">this is a test</div>, this is a test
     * ~~~
     *
     * - `PREG_OFFSET_CAPTURE`: If this flag is passed, for every occurring match the appendant string offset
     * (in bytes) will also be returned. Note that this changes the value of matches into an _array_ of _arrays_
     * where every element is an _array_ consisting of the matched string at offset `0` and its string offset into
     * `subject` at offset `1`.
     *
     * ```php
     * preg_match_all('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
     * print_r($matches);
     * ```
     *
     * The above example will output
     *
     * ~~~
     * Array
     * (
     *     [0] => Array
     *         (
     *             [0] => Array
     *                 (
     *                     [0] => foobarbaz
     *                     [1] => 0
     *                 )
     *
     *         )
     *
     *     [1] => Array
     *         (
     *             [0] => Array
     *                 (
     *                     [0] => foo
     *                     [1] => 0
     *                 )
     *
     *         )
     *
     *     [2] => Array
     *         (
     *             [0] => Array
     *                 (
     *                     [0] => bar
     *                     [1] => 3
     *                 )
     *
     *         )
     *
     *     [3] => Array
     *         (
     *             [0] => Array
     *                 (
     *                     [0] => baz
     *                     [1] => 6
     *                 )
     *
     *         )
     *
     * )
     * ~~~
     *
     * - `PREG_UNMATCHED_AS_NULL`: If this flag is passed, unmatched subpatterns are reported as `NULL`; otherwise they
     * are reported as an empty _string_.
     *
     * If no order flag is given, `PREG_PATTERN_ORDER` is assumed.
     *
     * @param  int  $offset  Normally, the search starts from the beginning of the `subject` string. The
     * optional parameter `offset` can be used to specify the alternate place from which to start the search (in bytes).
     * Using `offset` is not equivalent to passing substr($subject, $offset) to `preg_match_all` in place of the `subject`
     * string, because `pattern` can contain assertions such as `^`, `$` or `(?<=x)`. See [[preg_match()]] for
     * examples.
     *
     * ```php
     * Lib::preg_match_all("|]+>(.*)]+>|U", "example: this is a test", $out, PREG_PATTERN_ORDER);
     * echo $out[0][0] . ", " . $out[0][1] . "\n";
     * echo $out[1][0] . ", " . $out[1][1] . "\n";
     * ```
     *
     * The above example will output:
     *
     * ~~~
     * example: , this is a test
     * example: , this is a test
     * ~~~
     *
     * So, `$out[0]` contains _array_ of _strings_ that matched full pattern, and `$out[1]` contains _array_ of _strings_
     * enclosed by tags.
     *
     * @return int|false|null the number of full pattern matches (which might be zero), or `FALSE` if an error
     * occurred.
     */
    public static function preg_match_all($pattern, $subject, &$matches, $flags = PREG_PATTERN_ORDER, $offset = 0)
    {
        if (!isset($pattern) || !isset($subject)) {
            return 0;
        }

        return preg_match_all((string)$pattern, (string)$subject, $matches, $flags, $offset);
    }


    /**
     * Perform a regular expression search and replace.
     *
     * @link https://php.net/manual/en/function.preg-replace.php
     *
     * @param  string|string[]  $pattern  The pattern to search for. It can be either a _string_ or an _array_ with
     * strings. Several PCRE modifiers are also available, including the deprecated 'e' (PREG_REPLACE_EVAL), which
     * is specific to this function.
     * @param  string|string[]  $replacement  The _string_ or an _array_ with strings to replace.
     * - If this parameter is a _string_ and the `pattern` parameter is an _array_, all patterns will be replaced by
     * that string.
     * - If both `pattern` and `replacement ` parameters are _arrays_, each `pattern` will be replaced by the
     * `replacement` counterpart.
     * - If there are fewer elements in the `replacement` _array_ than in the `pattern` _array_, any extra
     * `pattern`s will be replaced by an empty _string_.
     * - `replacement` may contain references of the form `\\n` or (since PHP 4.0.4) `$n`, with the latter form being the preferred one. Every such reference will be replaced by
     * the text captured by the `n`'th parenthesized pattern. `n` can be from `0` to `99`, and `\\0` or `$0` refers to the text
     * matched by the whole pattern. Opening parentheses are counted from left to right (starting from `1`) to obtain
     * the number of the capturing subpattern. To use backslash in replacement, it must be doubled (`"\\\\"` PHP
     * string).
     * - When working with a replacement pattern where a backreference is immediately followed by another
     * number (i.e.: placing a literal number immediately after a matched pattern), you cannot use the familiar `\\1`
     * notation for your backreference. `\\11`, for example, would confuse `preg_replace` since it does not know
     * whether you want the `\\1` backreference followed by a literal 1, or the `\\11` backreference followed by
     * nothing. In this case the solution is to use `\${1}1`. This creates an isolated `$1` backreference, leaving the
     * `1` as a literal.
     * - When using the deprecated `e` modifier, this function escapes some characters (namely `'`, `"`, `\`
     * and `NULL`) in the strings that replace the backreferences. This is done to ensure that no syntax errors arise
     * from backreference usage with either single or double quotes (e.g. `strlen(\'$1\') + strlen("$2")`). Make sure
     * you are aware of PHP's _string_ syntax to know exactly how the interpreted string will look.
     * @param  string|string[]  $subject  The _string_ or an _array_ with strings to search and replace. If `subject` is an
     * _array_, then the search and replace is performed on every entry of `subject `, and the return value is an
     * _array_ as well.
     * @param  int  $limit  The maximum possible replacements for each pattern in each `subject` string.
     * Defaults to `-1` (no limit).
     * @param  int  $count  If specified, this variable will be filled with the number of replacements done.
     *
     * @return string|string[]|null `preg_replace` returns an _array_ if the `subject` parameter is an _array_, or a string
     * otherwise. If matches are found, the new `subject` will be returned, otherwise `subject` will be returned
     * unchanged or `NULL` if an error occurred.
     */
    public static function preg_replace($pattern, $replacement, $subject, $limit = -1, &$count = null)
    {
        if (!isset($pattern) || !isset($replacement) || !isset($subject)) {
            return '';
        }

        return isset($count) ? preg_replace($pattern, $replacement, $subject, $limit, $count) :
            preg_replace($pattern, $replacement, $subject, $limit);
    }

    /**
     * Perform a regular expression search and replace using a callback.
     *
     * @link https://php.net/manual/en/function.preg-replace-callback.php
     *
     * @param  string|string[]  $pattern  The pattern to search for. It can be either a _string_ or an _array_ with
     * strings.     *
     * @param  callable  $callback  A callback that will be called and passed an _array_ of matched elements in the
     * `subject` string. The callback should return the replacement string. This is the callback signature:
     *
     * ```php
     * handler(array $matches): string
     * ```
     *
     * You'll often need the `callback` function for a `preg_replace_callback` in  just one place. In this case you
     * can use an anonymous function to declare the callback within the call to `preg_replace_callback`. By doing it
     * this way you have all information for the call in one place and do not clutter the function namespace with a
     * callback function's name not used anywhere else.
     *
     * Example of usage of `preg_replace_callback` and anonymous function:
     *
     * ```php
     * // a unix-style command line filter to convert uppercase
     * // letters at the beginning of paragraphs to lowercase
     * $fp = fopen("php://stdin", "r") or die("can't read stdin");
     * while (!feof($fp)) {
     *     $line = fgets($fp);
     *     $line = Lib::preg_replace_callback( '|\s*\w|', function ($matches) {
     *          return Lib::strtolower($matches[0]);
     *     }, $line);
     *     echo $line;
     * }
     * fclose($fp);
     * ```
     * @param  string|string[]  $subject  The _string_ or an _array_ with strings to search and replace.
     * @param  int  $limit  The maximum possible replacements for each pattern in each `subject` string. Defaults to
     * `-1` (no limit).
     * @param  int  $count  If specified, this variable will be filled with the number of replacements done.
     * @param  int  $flags  can be a combination of the `PREG_OFFSET_CAPTURE` and `PREG_UNMATCHED_AS_NULL` flags,
     * which influence the format of the `matches` _array_. See the description in [[preg_match]] for more details.
     *
     * @return string|string[]|null `preg_replace_callback` returns an _array_ if the `subject` parameter is an _array_, or
     * a string otherwise. On errors the return value is `NULL` If matches are found, the new `subject` will be
     * returned, otherwise `subject` will be returned unchanged.
     */
    public static function preg_replace_callback($pattern, $callback, $subject, $limit = -1, &$count = null, $flags = 0)
    {
        if (!isset($pattern) || !isset($subject)) {
            return '';
        }

        return preg_replace_callback($pattern, $callback, $subject, $limit, $count, $flags);
    }

    /**
     * Perform a regular expression search and replace using callbacks.
     *
     * @link https://php.net/manual/en/function.preg-replace-callback-array.php
     *
     * @param  array|callable[]  $pattern  An associative _array_ mapping patterns (keys) to callbacks (values)
     * @param  string|string[]  $subject  The _string_ or an _array_ with strings to search and replace.
     * @param  int  $limit  The maximum possible replacements for each pattern in each `subject` string. Defaults to
     * `-1` (no limit).
     * @param  int  $count  If specified, this variable will be filled with the number of replacements done.
     * @param  int  $flags  can be a combination of the `PREG_OFFSET_CAPTURE` and `PREG_UNMATCHED_AS_NULL` flags,
     * which influence the format of the `matches` _array_. See the description in [[preg_match]] for more details.
     *
     * @return string|string[]|null  `preg_replace_callback_array()` returns an _array_ if the `subject` parameter is an
     * _array_, or a string otherwise. On errors the return value is NULL. If matches are found, the new `subject` will be
     * returned, otherwise `subject` will be returned unchanged.
     */
    public static function preg_replace_callback_array($pattern, $subject, $limit = -1, &$count = null, $flags = 0)
    {
        if (!isset($pattern) || !isset($subject)) {
            return '';
        }

        return preg_replace_callback_array($pattern, $subject, $limit, $count, $flags);
    }


    /**
     * Perform a regular expression search and replace.
     *
     * @link https://php.net/manual/en/function.preg-filter.php
     *
     * @param  string|string[]  $pattern  The pattern to search for. It can be either a _string_ or an _array_ with
     * strings. Several PCRE modifiers are also available, including the deprecated `e` (`PREG_REPLACE_EVAL`), which is specific
     * to this function.
     * @param  string|string[]  $replacement  The _string_ or an _array_ with strings to replace.
     * - If this parameter is a _string_ and the `pattern` parameter is an _array_, all patterns will be replaced by
     * that string.
     * - If both `pattern` and `replacement ` parameters are _arrays_, each `pattern` will be replaced by the
     * `replacement` counterpart.
     * - If there are fewer elements in the `replacement` _array_ than in the `pattern` _array_, any extra
     * `pattern`s will be replaced by an empty _string_.
     * - `replacement` may contain references of the form `\\n` or (since PHP 4.0.4) `$n`, with the latter form being the preferred one. Every such reference will be replaced by
     * the text captured by the `n`'th parenthesized pattern. `n` can be from `0` to `99`, and `\\0` or `$0` refers to the text
     * matched by the whole pattern. Opening parentheses are counted from left to right (starting from `1`) to obtain
     * the number of the capturing subpattern. To use backslash in replacement, it must be doubled (`"\\\\"` PHP
     * string).
     * - When working with a replacement pattern where a backreference is immediately followed by another
     * number (i.e.: placing a literal number immediately after a matched pattern), you cannot use the familiar `\\1`
     * notation for your backreference. `\\11`, for example, would confuse `preg_replace` since it does not know
     * whether you want the `\\1` backreference followed by a literal 1, or the `\\11` backreference followed by
     * nothing. In this case the solution is to use `\${1}1`. This creates an isolated `$1` backreference, leaving the
     * `1` as a literal.
     * - When using the deprecated `e` modifier, this function escapes some characters (namely `'`, `"`, `\`
     * and `NULL`) in the strings that replace the backreferences. This is done to ensure that no syntax errors arise
     * from backreference usage with either single or double quotes (e.g. `strlen(\'$1\') + strlen("$2")`). Make sure
     * you are aware of PHP's _string_ syntax to know exactly how the interpreted string will look.
     * @param  string|string[]  $subject  The _string_ or an _array_ with strings to search and replace. If `subject` is an
     * _array_, then the search and replace is performed on every entry of `subject `, and the return value is an
     * _array_ as well.
     * @param  int  $limit  The maximum possible replacements for each pattern in each `subject` string.
     * Defaults to `-1` (no limit).
     * @param  int  $count  If specified, this variable will be filled with the number of replacements done.
     *
     * @return string|string[]|null an _array_ if the `subject` parameter is an _array_, or a string otherwise. If no
     * matches are found or an error occurred, an empty _array_ is returned when `subject` is an _array_ or
     * `NULL` otherwise.
     */
    public static function preg_filter($pattern, $replacement, $subject, $limit = -1, &$count = null)
    {
        if (!isset($pattern) || !isset($subject)) {
            return '';
        }

        return isset($count) ? preg_filter($pattern, $replacement, $subject, $limit, $count) :
            preg_filter($pattern, $replacement, $subject, $limit);
    }

    /**
     * Split string by a regular expression.
     *
     * @link https://php.net/manual/en/function.preg-split.php
     *
     * @param  string  $pattern  The pattern to search for, as a string.
     * @param  string  $subject  The input string.
     * @param  int  $limit  If specified, then only substrings up to `limit` are returned with the rest of
     * the string being placed in the last substring. A `limit` of `-1`, `0` or `NULL` means "no limit" and, as is
     * standard across PHP, you can use `NULL` to skip to the `flags` parameter.
     * @param  int  $flags  `flags` can be any combination of the following flags (combined with the |
     * bitwise operator): `PREG_SPLIT_NO_EMPTY` If this flag is set, only non-empty pieces will be returned by
     * `preg_split`.
     *
     * @return string[]|false an _array_ containing substrings of `subject` split along boundaries matched by `pattern`,
     * or `FALSE` if an error occurred.
     */
    public static function preg_split($pattern, $subject, $limit = -1, $flags = 0)
    {
        if (!isset($pattern) || !isset($subject)) {
            return '';
        }

        return preg_split($pattern, $subject, $limit, $flags);
    }
}
