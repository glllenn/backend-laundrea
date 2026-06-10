<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundrea — Admin Panel</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <style>
        /* ==========================================
           FONTS IMPORT
        ========================================== */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&display=swap');

        /* ==========================================
           ROOT VARIABLES & COLOR PALETTE
        ========================================== */
        :root {
            /* Primary Colors */
            --clr-primary: #E07B39;
            --clr-primary-dark: #C45E20;
            --clr-primary-bg: #FEF3EA;
            --clr-primary-subtle: #FFF8F3;
            
            /* Sidebar Colors */
            --clr-sb-bg: #FFFBF7;
            --clr-sb-border: #F0E8DF;
            --clr-sb-item: #9C8F84;
            --clr-sb-active: #E07B39;
            --clr-sb-active-bg: #FEF0E4;
            --clr-sb-hover: #FDF6F0;
            
            /* Background & Card Colors */
            --clr-bg: #F7F4F0;
            --clr-card: #FFFFFF;
            --clr-border: #EDE9E3;
            
            /* Text Colors */
            --clr-text: #1E1A17;
            --clr-muted: #7A6F68;
            
            /* Status Colors: Success */
            --clr-success: #16A34A;
            --clr-success-bg: #DCFCE7;
            
            /* Status Colors: Warning */
            --clr-warning: #D97706;
            --clr-warning-bg: #FEF3C7;
            
            /* Status Colors: Info */
            --clr-info: #0284C7;
            --clr-info-bg: #E0F2FE;
            
            /* Status Colors: Danger */
            --clr-danger: #DC2626;
            --clr-danger-bg: #FEE2E2;
        }

        /* ==========================================
           GLOBAL RESET
        ========================================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        *::before {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        html {
            height: 100%;
            overflow: hidden;
        }
        
        body {
            height: 100%;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            background: var(--clr-bg);
            color: var(--clr-text);
        }

        /* ==========================================
           CUSTOM SCROLLBAR
        ========================================== */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #D6CDC5;
            border-radius: 99px;
        }

        /* ==========================================
           LAYOUT ROOT
        ========================================== */
        .app-root {
            display: flex;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        /* ==========================================
           SIDEBAR STYLES
        ========================================== */
        .sidebar {
            width: 220px;
            min-width: 220px;
            max-width: 220px;
            height: 100vh;
            background: var(--clr-sb-bg);
            border-right: 1px solid var(--clr-sb-border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            flex-shrink: 0;
            z-index: 10;
        }
        
        .sb-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 18px 16px;
            border-bottom: 1px solid var(--clr-sb-border);
            flex-shrink: 0;
        }
        
        .sb-logo-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, #E07B39, #F0A565);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(224, 123, 57, 0.28);
        }
        
        .sb-logo-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--clr-text);
        }
        
        .sb-logo-sub {
            font-size: 10px;
            color: var(--clr-sb-item);
            margin-top: 1px;
        }
        
        .sb-nav {
            flex: 1;
            overflow-y: auto;
            padding: 12px 10px;
        }
        
        .sb-section {
            font-size: 9px;
            font-weight: 700;
            color: #C4B8B0;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 8px 8px 4px;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.15s;
            color: var(--clr-sb-item);
            font-size: 12.5px;
            font-weight: 500;
            margin-bottom: 2px;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }
        
        .nav-item:hover {
            background: var(--clr-sb-hover);
            color: var(--clr-text);
        }
        
        .nav-item.active {
            background: var(--clr-sb-active-bg);
            color: var(--clr-sb-active);
            font-weight: 600;
        }
        
        .nav-item .ti {
            font-size: 15px;
            flex-shrink: 0;
        }
        
        .nav-dot {
            margin-left: auto;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--clr-primary);
            animation: blink 2s infinite;
        }
        
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.35; }
            100% { opacity: 1; }
        }

        .sb-foot {
            padding: 10px;
            border-top: 1px solid var(--clr-sb-border);
            flex-shrink: 0;
        }
        
        .sb-user {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 10px;
            border-radius: 8px;
            background: var(--clr-primary-bg);
            border: 1px solid rgba(224, 123, 57, 0.15);
            margin-bottom: 6px;
        }
        
        .sb-avatar {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--clr-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 11px;
            color: white;
            flex-shrink: 0;
        }
        
        .sb-uname {
            font-size: 12px;
            font-weight: 600;
            color: var(--clr-text);
        }
        
        .sb-urole {
            font-size: 10px;
            color: var(--clr-sb-item);
        }
        
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 10px;
            border-radius: 8px;
            color: var(--clr-muted);
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            background: transparent;
            border: none;
            width: 100%;
        }
        
        .btn-logout:hover {
            background: #FEE2E2;
            color: var(--clr-danger);
        }

        /* ==========================================
           MAIN AREA 
        ========================================== */
        .main-area {
            flex: 1;
            min-width: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* ── TOPBAR ── */
        .topbar {
            height: 56px;
            min-height: 56px;
            background: white;
            border-bottom: 1px solid var(--clr-border);
            padding: 0 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            z-index: 5;
        }
        
        .tb-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .tb-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--clr-text);
        }
        
        .tb-date {
            font-size: 11px;
            color: var(--clr-muted);
            background: var(--clr-bg);
            padding: 3px 9px;
            border-radius: 99px;
            border: 1px solid var(--clr-border);
        }
        
        .tb-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .tb-icon-btn {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid var(--clr-border);
            color: var(--clr-muted);
            cursor: pointer;
            transition: all .15s;
            position: relative;
            font-size: 16px;
        }
        
        .tb-icon-btn:hover {
            background: var(--clr-bg);
            color: var(--clr-text);
        }
        
        .tb-badge {
            position: absolute;
            top: -3px;
            right: -3px;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: var(--clr-primary);
            color: white;
            font-size: 8px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        /* ── CONTENT SCROLL AREA ── */
        .content-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 22px 26px 48px;
        }

        /* ==========================================
           NOTIF PANEL OVERLAY
        ========================================== */
        .notif-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .18);
            z-index: 38;
            display: none;
        }
        
        .notif-overlay.open {
            display: block;
        }
        
        .notif-panel {
            position: fixed;
            top: 0;
            right: -360px;
            width: 340px;
            height: 100vh;
            background: white;
            border-left: 1px solid var(--clr-border);
            z-index: 39;
            display: flex;
            flex-direction: column;
            transition: right .25s cubic-bezier(.4, 0, .2, 1);
            box-shadow: -4px 0 24px rgba(0, 0, 0, .07);
        }
        
        .notif-panel.open {
            right: 0;
        }
        
        .notif-head {
            padding: 16px 16px 14px;
            border-bottom: 1px solid var(--clr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        
        .notif-title {
            font-size: 14px;
            font-weight: 700;
        }
        
        .notif-count {
            font-size: 11px;
            color: var(--clr-muted);
            margin-top: 2px;
        }
        
        .notif-list {
            flex: 1;
            overflow-y: auto;
            padding: 8px;
        }
        
        .notif-item {
            display: flex;
            gap: 10px;
            padding: 10px 10px;
            border-radius: 8px;
            margin-bottom: 2px;
            transition: background .1s;
            cursor: default;
        }
        
        .notif-item:hover {
            background: var(--clr-bg);
        }
        
        .notif-icon {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
            margin-top: 1px;
        }
        
        .notif-msg {
            font-size: 12px;
            color: var(--clr-text);
            line-height: 1.5;
        }
        
        .notif-time {
            font-size: 10px;
            color: var(--clr-muted);
            margin-top: 2px;
        }
        
        .notif-empty {
            text-align: center;
            padding: 48px 20px;
            color: var(--clr-muted);
            font-size: 12px;
        }

        /* ==========================================
           CARDS & STATISTICS
        ========================================== */
        .card {
            background: var(--clr-card);
            border: 1px solid var(--clr-border);
            border-radius: 12px;
        }
        
        .card-hd {
            padding: 13px 16px;
            border-bottom: 1px solid var(--clr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-hd-title {
            font-size: 13px;
            font-weight: 600;
        }

        .stat-card {
            background: var(--clr-card);
            border: 1px solid var(--clr-border);
            border-radius: 12px;
            padding: 16px;
        }
        
        .stat-lbl {
            font-size: 10px;
            font-weight: 700;
            color: var(--clr-muted);
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 8px;
        }
        
        .stat-val {
            font-size: 24px;
            font-weight: 700;
            line-height: 1;
        }
        
        .stat-sub {
            font-size: 11px;
            color: var(--clr-muted);
            margin-top: 5px;
        }

        /* ==========================================
           BUTTONS
        ========================================== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all .15s;
            border: none;
            font-family: 'Inter', sans-serif;
        }
        
        .btn-primary {
            background: var(--clr-primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--clr-primary-dark);
        }
        
        .btn-secondary {
            background: #F5F2EE;
            color: var(--clr-muted);
            border: 1px solid var(--clr-border);
        }
        
        .btn-secondary:hover {
            background: var(--clr-border);
            color: var(--clr-text);
        }
        
        .btn-ghost {
            background: transparent;
            color: var(--clr-muted);
            border: 1px solid var(--clr-border);
        }
        
        .btn-ghost:hover {
            background: var(--clr-bg);
        }
        
        .btn-sm {
            padding: 6px 10px;
            font-size: 11px;
        }
        
        .tbl-actions {
            display: flex;
            align-items: center;
            gap: 4px;
            justify-content: flex-end;
        }
        
        .btn-icon {
            padding: 6px;
            border-radius: 6px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-edit {
            background: var(--clr-info-bg);
            color: var(--clr-info);
        }
        
        .btn-edit:hover {
            background: #BAE6FD;
        }
        
        .btn-del {
            background: var(--clr-danger-bg);
            color: var(--clr-danger);
        }
        
        .btn-del:hover {
            background: #FECACA;
        }

        /* ==========================================
           FORMS & INPUTS
        ========================================== */
        .form-lbl {
            display: block;
            font-size: 10px;
            font-weight: 700;
            color: var(--clr-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 5px;
        }
        
        .form-input {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid var(--clr-border);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--clr-text);
            background: white;
            transition: all .15s;
            font-family: 'Inter', sans-serif;
        }
        
        .form-input:focus {
            border-color: var(--clr-primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(224, 123, 57, .1);
        }
        
        select.form-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%237A6F68' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 14px;
            padding-right: 30px;
            cursor: pointer;
        }
        
        .form-file {
            width: 100%;
            font-size: 11px;
            color: var(--clr-muted);
        }
        
        .form-file::file-selector-button {
            margin-right: 8px;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid var(--clr-border);
            background: white;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            color: var(--clr-text);
        }
        
        .form-file::file-selector-button:hover {
            background: var(--clr-bg);
        }
        
        .form-grp {
            margin-bottom: 14px;
        }

        /* ==========================================
           TABLES
        ========================================== */
        .dtable {
            width: 100%;
            border-collapse: collapse;
        }
        
        .dtable thead th {
            background: #FAFAF8;
            color: var(--clr-muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .6px;
            font-weight: 700;
            padding: 10px 14px;
            border-bottom: 1px solid var(--clr-border);
            text-align: left;
            white-space: nowrap;
        }
        
        .dtable tbody td {
            padding: 12px 14px;
            font-size: 13px;
            border-bottom: 1px solid #F7F4F0;
            vertical-align: middle;
        }
        
        .dtable tbody tr {
            background: white;
            transition: background .1s;
        }
        
        .dtable tbody tr:hover {
            background: var(--clr-primary-subtle);
        }
        
        .dtable tbody tr:last-child td {
            border-bottom: none;
        }
        
        .empty-row td {
            padding: 36px 20px;
            text-align: center;
            color: var(--clr-muted);
            font-size: 13px;
        }
        
        .clickable {
            cursor: pointer;
        }

        /* ==========================================
           BADGES (STATUS)
        ========================================== */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 3px 9px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }
        
        .b-antrian {
            background: #F5F2EE;
            color: #7A6F68;
        }
        
        .b-dicuci {
            background: var(--clr-info-bg);
            color: var(--clr-info);
        }
        
        .b-disetrika {
            background: #EDE9FE;
            color: #7C3AED;
        }
        
        .b-siap {
            background: #CCFBF1;
            color: #0F766E;
        }
        
        .b-selesai {
            background: var(--clr-success-bg);
            color: var(--clr-success);
        }

        /* ==========================================
           MODAL DIALOGS
        ========================================== */
        .modal-ov {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .28);
            backdrop-filter: blur(2px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
            padding: 16px;
        }
        
        .modal-ov.open {
            display: flex;
        }
        
        .modal-box {
            background: white;
            border-radius: 14px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .12);
            overflow: hidden;
            animation: mIn .2s ease-out;
        }
        
        @keyframes mIn {
            0% {
                opacity: 0;
                transform: translateY(10px) scale(.98);
            }
            100% {
                opacity: 1;
                transform: none;
            }
        }
        
        .modal-hd {
            padding: 13px 18px;
            border-bottom: 1px solid var(--clr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FAFAF8;
        }
        
        .modal-title {
            font-size: 13px;
            font-weight: 700;
        }
        
        .modal-close {
            background: none;
            border: none;
            color: var(--clr-muted);
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            font-size: 18px;
            line-height: 1;
        }
        
        .modal-close:hover {
            background: var(--clr-danger-bg);
            color: var(--clr-danger);
        }
        
        .modal-body {
            padding: 18px;
            overflow-y: auto;
        }
        
        .modal-ft {
            padding: 12px 18px;
            border-top: 1px solid var(--clr-border);
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            background: #FAFAF8;
        }

        /* ==========================================
           TOAST NOTIFICATION
        ========================================== */
        .toast-wrap {
            position: fixed;
            top: 14px;
            right: 14px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 8px;
            pointer-events: none;
        }
        
        .toast {
            background: white;
            border: 1px solid var(--clr-border);
            border-radius: 10px;
            padding: 11px 13px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            min-width: 240px;
            max-width: 320px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .08);
            pointer-events: all;
            animation: tIn .2s ease-out;
        }
        
        @keyframes tIn {
            0% {
                opacity: 0;
                transform: translateX(14px);
            }
            100% {
                opacity: 1;
                transform: none;
            }
        }
        
        .toast.hiding {
            animation: tOut .2s ease-in forwards;
        }
        
        @keyframes tOut {
            100% {
                opacity: 0;
                transform: translateX(14px);
            }
        }
        
        .toast-ico {
            width: 24px;
            height: 24px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }
        
        .toast-ico.success {
            background: var(--clr-success-bg);
            color: var(--clr-success);
        }
        
        .toast-ico.error {
            background: var(--clr-danger-bg);
            color: var(--clr-danger);
        }
        
        .toast-ico.info {
            background: var(--clr-info-bg);
            color: var(--clr-info);
        }
        
        .toast-ico.warning {
            background: var(--clr-warning-bg);
            color: var(--clr-warning);
        }
        
        .toast-ttl {
            font-size: 12px;
            font-weight: 700;
        }
        
        .toast-msg {
            font-size: 11px;
            color: var(--clr-muted);
            margin-top: 2px;
        }

        /* ==========================================
           RECEIPT THERMAL LAYOUT
        ========================================== */
        .receipt {
            font-family: 'Courier Prime', 'Courier New', monospace;
            background: white;
            padding: 24px;
            border: 1px dashed #C8BFB6;
            border-radius: 4px;
            width: 100%;
            color: #000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin: 0 auto;
        }
        
        .r-dash {
            border: none;
            border-top: 1px dashed #000;
            margin: 12px 0;
        }
        
        .r-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            line-height: 1.8;
            margin-bottom: 2px;
        }
        
        .r-ctr {
            text-align: center;
        }
        
        .r-bold {
            font-weight: 700;
        }
        
        .srch {
            position: relative;
        }
        
        .srch .ti-search {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--clr-muted);
            font-size: 14px;
            pointer-events: none;
        }
        
        .srch input {
            padding-left: 32px !important;
        }

        /* ==========================================
           GALLERY FOR PHOTOS
        ========================================== */
        .gal-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        
        .gal-item {
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--clr-border);
            background: white;
            padding: 4px;
        }
        
        .gal-lbl {
            background: #FAFAF8;
            font-size: 9px;
            font-weight: 700;
            color: var(--clr-muted);
            padding: 4px 6px;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 4px;
            text-align: center;
            border-radius: 4px;
        }
        
        .gal-item img {
            width: 100%;
            height: 90px;
            object-fit: cover;
            display: block;
            border-radius: 4px;
            cursor: pointer;
            transition: opacity .15s;
        }
        
        .gal-item img:hover {
            opacity: .8;
        }
        
        .gal-empty {
            font-size: 11px;
            color: var(--clr-muted);
            text-align: center;
            padding: 20px;
            background: #FAFAF8;
            border-radius: 8px;
            border: 1px dashed var(--clr-border);
        }

        /* ==========================================
           MISC UTILITIES
        ========================================== */
        .hl-box {
            background: var(--clr-primary-bg);
            border: 1px solid rgba(224, 123, 57, .18);
            border-radius: 8px;
            padding: 12px 13px;
        }
        
        .view-sec {
            animation: vFade .18s ease-out;
        }
        
        @keyframes vFade {
            0% {
                opacity: 0;
                transform: translateY(6px);
            }
            100% {
                opacity: 1;
                transform: none;
            }
        }
        
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* ==========================================
           PRINT MEDIA QUERIES
        ========================================== */
        @media print {
            body * {
                visibility: hidden !important;
            }
            
            #printableReceipt, #printableReceipt * {
                visibility: visible !important;
            }
            
            #printableReceipt {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 80mm !important;
                margin: 0 !important;
                padding: 10px !important;
                border: none !important;
                box-shadow: none !important;
                background: white !important;
                color: black !important;
                font-family: 'Courier Prime', 'Courier New', monospace !important;
            }
            
            .no-print {
                display: none !important;
            }
            
            .modal-ov {
                background: transparent !important;
            }
        }
    </style>
</head>
<body>

<div class="toast-wrap" id="toastWrap"></div>

<div class="notif-overlay" id="notifOverlay" onclick="closeNotif()"></div>

<div class="notif-panel" id="notifPanel">
    <div class="notif-head">
        <div>
            <div class="notif-title">Aktivitas</div>
            <div class="notif-count" id="notifCount">0 aktivitas</div>
        </div>
        <div style="display:flex;gap:6px;">
            <button onclick="clearActivities()" class="btn btn-secondary btn-sm btn-icon" title="Hapus semua">
                <i class="ti ti-trash" style="font-size:13px;"></i>
            </button>
            <button onclick="closeNotif()" class="btn btn-ghost btn-sm btn-icon">
                <i class="ti ti-x" style="font-size:13px;"></i>
            </button>
        </div>
    </div>
    
    <div class="notif-list" id="notifList">
        <div class="notif-empty">
            <i class="ti ti-bell-off" style="font-size:28px;display:block;margin-bottom:8px;opacity:.35;"></i>
            Belum ada aktivitas
        </div>
    </div>
</div>

<div class="app-root">

    <aside class="sidebar">
        <div class="sb-logo">
            <div class="sb-logo-icon">LA</div>
            <div>
                <div class="sb-logo-name">Laundrea</div>
                <div class="sb-logo-sub">Admin Panel</div>
            </div>
        </div>
        
        <nav class="sb-nav">
            <div class="sb-section">Menu</div>
            
            <button class="nav-item active" id="nav-beranda" onclick="switchTab('beranda')">
                <i class="ti ti-layout-dashboard"></i>
                <span>Dashboard</span>
            </button>
            
            <button class="nav-item" id="nav-transaksi" onclick="switchTab('transaksi')">
                <i class="ti ti-file-invoice"></i>
                <span>Transaksi POS</span>
                <span class="nav-dot" id="transaksiDot" style="display:none;"></span>
            </button>
            
            <button class="nav-item" id="nav-layanan" onclick="switchTab('layanan')">
                <i class="ti ti-stack-2"></i>
                <span>Katalog Layanan</span>
            </button>
            
            <button class="nav-item" id="nav-pelanggan" onclick="switchTab('pelanggan')">
                <i class="ti ti-users"></i>
                <span>Data Pelanggan</span>
            </button>
        </nav>
        
        <div class="sb-foot">
            <div class="sb-user">
                <div class="sb-avatar" id="sbAvatar">AD</div>
                <div>
                    <div class="sb-uname" id="sbAdminName">Admin</div>
                    <div class="sb-urole">Administrator</div>
                </div>
            </div>
            <button class="btn-logout" onclick="logout()">
                <i class="ti ti-logout" style="font-size:14px;"></i> Keluar
            </button>
        </div>
    </aside>

    <div class="main-area">

        <header class="topbar">
            <div class="tb-left">
                <span class="tb-title" id="topbarTitle">Dashboard</span>
                <span class="tb-date" id="currentDate"></span>
            </div>
            
            <div class="tb-right">
                <button class="tb-icon-btn" onclick="openNotif()" title="Aktivitas">
                    <i class="ti ti-bell" style="font-size:16px;"></i>
                    <span class="tb-badge" id="notifBadge" style="display:none;">0</span>
                </button>
                <button onclick="switchTab('transaksi');setTimeout(openTrxModal,100);" class="btn btn-primary btn-sm">
                    <i class="ti ti-plus" style="font-size:13px;"></i> Transaksi Baru
                </button>
            </div>
        </header>

        <div class="content-scroll">

            <div id="view-beranda" class="view-sec">

                <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;">
                    <div>
                        <h1 style="font-size:19px;font-weight:700;">Selamat datang</h1>
                        <p style="font-size:12px;color:var(--clr-muted);margin-top:4px;">Ringkasan aktivitas laundry Anda hari ini.</p>
                    </div>
                    <button onclick="doRefresh()" class="btn btn-secondary btn-sm">
                        <i class="ti ti-refresh" style="font-size:13px;"></i> Refresh
                    </button>
                </div>

                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:16px;">
                    
                    <div class="stat-card" style="border-left:3px solid #60A5FA;">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                            <div class="stat-lbl">Total Pelanggan</div>
                            <div style="width:34px;height:34px;border-radius:9px;background:var(--clr-info-bg);display:flex;align-items:center;justify-content:center;">
                                <i class="ti ti-users" style="color:var(--clr-info);font-size:17px;"></i>
                            </div>
                        </div>
                        <div class="stat-val" id="stat-customers">0</div>
                        <div class="stat-sub">Terdaftar</div>
                    </div>
                    
                    <div class="stat-card" style="border-left:3px solid #FBBF24;">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                            <div class="stat-lbl">Pesanan Aktif</div>
                            <div style="width:34px;height:34px;border-radius:9px;background:var(--clr-warning-bg);display:flex;align-items:center;justify-content:center;">
                                <i class="ti ti-loader-2" style="color:var(--clr-warning);font-size:17px;"></i>
                            </div>
                        </div>
                        <div class="stat-val" id="stat-active">0</div>
                        <div class="stat-sub">Belum diambil</div>
                    </div>
                    
                    <div class="stat-card" style="border-left:3px solid #A3A3A3;">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                            <div class="stat-lbl">Total Transaksi</div>
                            <div style="width:34px;height:34px;border-radius:9px;background:#F5F2EE;display:flex;align-items:center;justify-content:center;">
                                <i class="ti ti-file-invoice" style="color:var(--clr-muted);font-size:17px;"></i>
                            </div>
                        </div>
                        <div class="stat-val" id="stat-transactions">0</div>
                        <div class="stat-sub">Nota tercatat</div>
                    </div>
                    
                    <div class="stat-card" style="background:var(--clr-primary);border-color:var(--clr-primary);border-left:3px solid rgba(255,255,255,.4);">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                            <div class="stat-lbl" style="color:rgba(255,255,255,.7);">Total Omzet</div>
                            <div style="width:34px;height:34px;border-radius:9px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;">
                                <i class="ti ti-currency-dollar" style="color:white;font-size:17px;"></i>
                            </div>
                        </div>
                        <div class="stat-val" style="color:white;font-size:18px;" id="stat-revenue">Rp 0</div>
                        <div class="stat-sub" style="color:rgba(255,255,255,.65);">Keseluruhan</div>
                    </div>

                </div>

                <div style="display:grid;grid-template-columns:2fr 1fr;gap:12px;margin-bottom:16px;">
                    
                    <div class="card">
                        <div class="card-hd">
                            <span class="card-hd-title">Status Pesanan</span>
                            <div style="display:flex;gap:5px;">
                                <button onclick="renderChart(trxData,'bar')" class="btn btn-ghost btn-sm btn-icon">
                                    <i class="ti ti-chart-bar" style="font-size:13px;"></i>
                                </button>
                                <button onclick="renderChart(trxData,'doughnut')" class="btn btn-ghost btn-sm btn-icon">
                                    <i class="ti ti-chart-donut" style="font-size:13px;"></i>
                                </button>
                            </div>
                        </div>
                        <div style="padding:14px;height:200px;position:relative;">
                            <canvas id="mainChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-hd">
                            <span class="card-hd-title">Layanan Favorit</span>
                            <i class="ti ti-award" style="font-size:14px;color:var(--clr-muted);"></i>
                        </div>
                        <div style="padding:14px;">
                            <div id="popularList" style="display:flex;flex-direction:column;gap:10px;"></div>
                        </div>
                    </div>

                </div>

                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:16px;">
                    
                    <div class="stat-card" style="border-left:3px solid #4ADE80;">
                        <div class="stat-lbl">Pendapatan Lunas</div>
                        <div class="stat-val" id="rep-paid" style="font-size:18px;color:var(--clr-success);">Rp 0</div>
                        <div class="stat-sub">Status paid / lunas</div>
                    </div>
                    
                    <div class="stat-card" style="border-left:3px solid #34D399;">
                        <div class="stat-lbl">Transaksi Selesai</div>
                        <div class="stat-val" id="rep-done" style="font-size:18px;">0</div>
                        <div class="stat-sub">Status diambil</div>
                    </div>
                    
                    <div class="stat-card" style="border-left:3px solid #FBBF24;">
                        <div class="stat-lbl">Masih Berlangsung</div>
                        <div class="stat-val" id="rep-pending" style="font-size:18px;">0</div>
                        <div class="stat-sub">Belum selesai</div>
                    </div>

                </div>

                <div class="card">
                    <div class="card-hd">
                        <span class="card-hd-title">Transaksi Terbaru</span>
                        <button onclick="switchTab('transaksi')" style="font-size:11px;font-weight:600;color:var(--clr-primary);background:none;border:none;cursor:pointer;">
                            Lihat Semua →
                        </button>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="dtable">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Invoice</th>
                                    <th>Layanan</th>
                                    <th>Total</th>
                                    <th style="text-align:center;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="recentTBody">
                                <tr class="empty-row">
                                    <td colspan="5">Memuat...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div id="view-transaksi" class="view-sec" style="display:none;">
                
                <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:16px;flex-wrap:wrap;gap:10px;">
                    <div>
                        <h2 style="font-size:18px;font-weight:700;">Transaksi POS</h2>
                        <p style="font-size:12px;color:var(--clr-muted);margin-top:4px;">Klik baris pesanan untuk detail & update status.</p>
                    </div>
                    
                    <div style="display:flex;flex-wrap:wrap;gap:7px;align-items:center;">
                        <button onclick="exportCSV()" class="btn btn-secondary btn-sm">
                            <i class="ti ti-download" style="font-size:13px;"></i> Ekspor CSV
                        </button>
                        
                        <div class="srch">
                            <i class="ti ti-search"></i>
                            <input type="text" id="srchTrx" placeholder="Cari nama/invoice..." class="form-input" style="padding:7px 12px 7px 32px;width:180px;font-size:12px;" oninput="filterTrxLocal()">
                        </div>
                        
                        <input type="date" id="filterDate" onchange="fetchTrx()" class="form-input" style="width:130px;font-size:12px;padding:7px 12px;">
                        
                        <select id="filterStatus" onchange="fetchTrx()" class="form-input" style="width:145px;font-size:12px;padding:7px 28px 7px 12px;">
                            <option value="">Semua Status</option>
                            <option value="antrian">Antrian</option>
                            <option value="dicuci">Dicuci</option>
                            <option value="disetrika">Disetrika</option>
                            <option value="siap diambil">Siap Diambil</option>
                            <option value="diambil">Selesai</option>
                        </select>
                    </div>
                </div>
                
                <div class="card" style="overflow:hidden;">
                    <div style="overflow-x:auto;">
                        <table class="dtable">
                            <thead>
                                <tr>
                                    <th>Waktu & Invoice</th>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Tagihan</th>
                                    <th>Bayar</th>
                                    <th style="text-align:center;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="trxTBody">
                                <tr class="empty-row">
                                    <td colspan="6">Memuat...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <div id="view-layanan" class="view-sec" style="display:none;">
                
                <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:16px;">
                    <div>
                        <h2 style="font-size:18px;font-weight:700;">Katalog Layanan</h2>
                        <p style="font-size:12px;color:var(--clr-muted);margin-top:4px;">Kelola harga dan jenis layanan.</p>
                    </div>
                    <button onclick="openSrvModal()" class="btn btn-primary btn-sm">
                        <i class="ti ti-plus" style="font-size:13px;"></i> Tambah Layanan
                    </button>
                </div>
                
                <div class="card" style="overflow:hidden;">
                    <div style="overflow-x:auto;">
                        <table class="dtable">
                            <thead>
                                <tr>
                                    <th>Nama Layanan</th>
                                    <th>Harga Pokok</th>
                                    <th>Tipe Satuan</th>
                                    <th style="text-align:right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="srvTBody">
                                <tr class="empty-row">
                                    <td colspan="4">Memuat...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <div id="view-pelanggan" class="view-sec" style="display:none;">
                
                <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:16px;flex-wrap:wrap;gap:10px;">
                    <div>
                        <h2 style="font-size:18px;font-weight:700;">Data Pelanggan</h2>
                        <p style="font-size:12px;color:var(--clr-muted);margin-top:4px;">Database pelanggan terdaftar.</p>
                    </div>
                    
                    <div style="display:flex;gap:7px;align-items:center;flex-wrap:wrap;">
                        <div class="srch">
                            <i class="ti ti-search"></i>
                            <input type="text" id="srchCust" placeholder="Cari nama/WA..." class="form-input" style="padding:7px 12px 7px 32px;width:180px;font-size:12px;" onkeyup="if(event.key==='Enter')fetchCusts()">
                        </div>
                        <button onclick="fetchCusts()" class="btn btn-secondary btn-sm">
                            <i class="ti ti-search" style="font-size:13px;"></i>
                        </button>
                        <button onclick="openCustModal()" class="btn btn-primary btn-sm">
                            <i class="ti ti-user-plus" style="font-size:13px;"></i> Registrasi
                        </button>
                    </div>
                </div>
                
                <div class="card" style="overflow:hidden;">
                    <div style="overflow-x:auto;">
                        <table class="dtable">
                            <thead>
                                <tr>
                                    <th>Info Pelanggan</th>
                                    <th>WhatsApp</th>
                                    <th>Alamat Domisili</th>
                                    <th>Trx Selesai</th>
                                    <th style="text-align:right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="custTBody">
                                <tr class="empty-row">
                                    <td colspan="5">Memuat...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

        </div></div></div><div class="modal-ov" id="srvModal">
    <div class="modal-box" style="max-width:380px;">
        <div class="modal-hd">
            <span class="modal-title" id="srvModalTitle">Tambah Layanan</span>
            <button class="modal-close" onclick="closeModal('srvModal')">
                <i class="ti ti-x"></i>
            </button>
        </div>
        
        <form id="srvForm">
            <div class="modal-body">
                <input type="hidden" id="srv_id">
                
                <div class="form-grp">
                    <label class="form-lbl">Nama Layanan</label>
                    <input type="text" id="srv_name" class="form-input" placeholder="Cuci Kiloan Premium" required>
                </div>
                
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                    <div class="form-grp">
                        <label class="form-lbl">Tipe Satuan</label>
                        <select id="srv_type" class="form-input" required>
                            <option value="kiloan">Per Kg</option>
                            <option value="satuan">Per Pcs</option>
                        </select>
                    </div>
                    
                    <div class="form-grp">
                        <label class="form-lbl">Harga (Rp)</label>
                        <input type="number" id="srv_price" class="form-input" placeholder="15000" required>
                    </div>
                </div>
            </div>
            
            <div class="modal-ft">
                <button type="button" onclick="closeModal('srvModal')" class="btn btn-secondary btn-sm">Batal</button>
                <button type="submit" id="btnSaveSrv" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-ov" id="custModal">
    <div class="modal-box" style="max-width:400px;max-height:90vh;overflow-y:auto;">
        <div class="modal-hd">
            <span class="modal-title" id="custModalTitle">Registrasi Pelanggan</span>
            <button class="modal-close" onclick="closeModal('custModal')">
                <i class="ti ti-x"></i>
            </button>
        </div>
        
        <form id="custForm">
            <div class="modal-body">
                <input type="hidden" id="cust_id">
                
                <div class="form-grp">
                    <label class="form-lbl">Nama Lengkap</label>
                    <input type="text" id="cust_name" class="form-input" required>
                </div>
                
                <div id="authFields" class="hl-box" style="margin-bottom:14px;">
                    <p style="font-size:10px;font-weight:700;color:var(--clr-primary);text-transform:uppercase;letter-spacing:.5px;margin:0 0 10px;">
                        Akses Aplikasi Mobile
                    </p>
                    
                    <div class="form-grp" style="margin-bottom:10px;">
                        <label class="form-lbl">Email Login</label>
                        <input type="email" id="cust_email" class="form-input" placeholder="email@pelanggan.com">
                    </div>
                    
                    <div class="form-grp" style="margin-bottom:0;">
                        <label class="form-lbl">Password</label>
                        <input type="password" id="cust_pass" class="form-input" placeholder="Min. 8 karakter">
                    </div>
                </div>
                
                <div class="form-grp">
                    <label class="form-lbl">No. WhatsApp</label>
                    <input type="number" id="cust_phone" class="form-input" placeholder="08xxxxxxxxxx" required>
                </div>
                
                <div class="form-grp" style="margin-bottom:0;">
                    <label class="form-lbl">Alamat Domisili</label>
                    <textarea id="cust_addr" class="form-input" rows="2" required style="resize:vertical;"></textarea>
                </div>
            </div>
            
            <div class="modal-ft">
                <button type="button" onclick="closeModal('custModal')" class="btn btn-secondary btn-sm">Batal</button>
                <button type="submit" id="btnSaveCust" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-ov" id="trxModal">
    <div class="modal-box" style="max-width:460px;max-height:90vh;overflow-y:auto;">
        <div class="modal-hd">
            <span class="modal-title">
                <i class="ti ti-file-plus" style="font-size:14px;color:var(--clr-primary);margin-right:5px;"></i> Form Nota Baru
            </span>
            <button class="modal-close" onclick="closeModal('trxModal')">
                <i class="ti ti-x"></i>
            </button>
        </div>
        
        <form id="trxForm">
            <div class="modal-body">
                <div class="form-grp">
                    <label class="form-lbl">Pelanggan</label>
                    <select id="trx_cust" class="form-input" required></select>
                </div>
                
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                    <div class="form-grp">
                        <label class="form-lbl">Layanan</label>
                        <select id="trx_srv" class="form-input" required onchange="updateQtyLabel()"></select>
                    </div>
                    
                    <div class="form-grp">
                        <label id="lblQty" class="form-lbl">Kuantitas</label>
                        <input type="number" step="any" id="trx_qty" class="form-input" placeholder="Cth: 2.5" required>
                    </div>
                </div>
                
                <div class="form-grp">
                    <label class="form-lbl">Metode Pembayaran</label>
                    <select id="trx_pay" class="form-input" required onchange="toggleProof()">
                        <option value="cash">Tunai (Bayar di Kasir)</option>
                        <option value="transfer">Transfer Bank / QRIS</option>
                    </select>
                </div>
                
                <div id="proofBox" style="display:none;" class="form-grp">
                    <div class="hl-box">
                        <label class="form-lbl" style="margin-bottom:7px;">Upload Bukti Transfer</label>
                        <input type="file" id="trx_proof" accept="image/*" class="form-file">
                    </div>
                </div>
                
                <div class="hl-box">
                    <label class="form-lbl" style="margin-bottom:7px;">
                        <i class="ti ti-camera" style="font-size:11px;"></i> Foto Pakaian Masuk (Opsional)
                    </label>
                    <input type="file" id="trx_photo" accept="image/*" class="form-file">
                </div>
            </div>
            
            <div class="modal-ft">
                <button type="button" onclick="closeModal('trxModal')" class="btn btn-secondary btn-sm">Batal</button>
                <button type="submit" id="btnSaveTrx" class="btn btn-primary btn-sm">
                    <i class="ti ti-device-floppy" style="font-size:12px;"></i> Simpan Order
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal-ov" id="detailModal">
    <div class="modal-box" style="max-width:820px;max-height:92vh;overflow-y:auto;background:#FAFAF8;">
        
        <div class="modal-hd no-print" style="background:white;">
            <div style="display:flex;align-items:center;gap:9px;">
                <i class="ti ti-info-circle" style="font-size:15px;color:var(--clr-primary);"></i>
                <span class="modal-title">Detail Transaksi</span>
                <span id="detBadge"></span>
            </div>
            <button class="modal-close" onclick="closeModal('detailModal')">
                <i class="ti ti-x"></i>
            </button>
        </div>

        <div style="display:flex;flex-wrap:wrap;flex-direction:row;">
            
            <div class="no-print" style="flex:1;min-width:300px;padding:20px;border-right:1px solid var(--clr-border);">
                
                <div style="margin-bottom:20px;background:white;padding:16px;border-radius:12px;border:1px solid var(--clr-border);">
                    <div style="font-size:10px;font-weight:700;color:var(--clr-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:14px;">
                        Progress Cucian
                    </div>
                    <div id="progTracker"></div>
                </div>

                <div style="background:white;padding:16px;border-radius:12px;border:1px solid var(--clr-border);margin-bottom:20px;">
                    <div style="font-size:12px;font-weight:700;margin-bottom:12px;">Update Progress</div>
                    
                    <form id="statusForm">
                        <input type="hidden" id="det_trx_id">
                        
                        <div class="form-grp">
                            <label class="form-lbl">Status Baru</label>
                            <select id="det_status" class="form-input" style="font-weight:600;">
                                <option value="antrian">1. Antrian Masuk</option>
                                <option value="dicuci">2. Sedang Dicuci</option>
                                <option value="disetrika">3. Sedang Disetrika</option>
                                <option value="siap diambil">4. Siap Diambil</option>
                                <option value="diambil">5. Selesai (Diambil)</option>
                            </select>
                        </div>
                        
                        <div class="hl-box form-grp" style="margin-bottom:12px;">
                            <label class="form-lbl" style="margin-bottom:7px;">
                                <i class="ti ti-photo" style="font-size:11px;"></i> Lampirkan Foto Hasil (Opsional)
                            </label>
                            <input type="file" id="det_photo" accept="image/*" class="form-file">
                        </div>
                        
                        <button type="submit" id="btnUpdateStatus" class="btn btn-primary" style="width:100%;justify-content:center;">
                            <i class="ti ti-check" style="font-size:13px;"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

                <div style="background:white;padding:16px;border-radius:12px;border:1px solid var(--clr-border);">
                    <div style="font-size:12px;font-weight:700;margin-bottom:10px;">
                        Galeri Foto Bukti & Progress
                    </div>
                    <div id="galTracking"></div>
                </div>
            </div>

            <div style="width:340px;min-width:340px;padding:20px;background:#F5F2EE;display:flex;flex-direction:column;gap:12px;align-items:center;">
                <button onclick="window.print()" class="btn btn-primary no-print" style="width:100%;justify-content:center;padding:10px;font-size:13px;box-shadow:0 4px 10px rgba(0,0,0,0.1);">
                    <i class="ti ti-printer" style="font-size:15px;"></i> Cetak Struk
                </button>
                
                <div id="printableReceipt" class="receipt">
                    <div class="r-ctr" style="margin-bottom:14px;">
                        <div style="font-size:22px;font-weight:700;letter-spacing:4px;margin-bottom:4px;">LAUNDREA</div>
                        <div style="font-size:11px;">Sistem Cerdas Laundry</div>
                        <div style="font-size:11px;margin-top:2px;" id="r_date">-</div>
                    </div>
                    
                    <hr class="r-dash">
                    
                    <div style="margin:10px 0;line-height:1.6;">
                        <div class="r-row">
                            <span>No. Nota:</span>
                            <span class="r-bold" id="r_inv">-</span>
                        </div>
                        <div class="r-row">
                            <span>Pelanggan:</span>
                            <span class="r-bold" id="r_cust">-</span>
                        </div>
                        <div class="r-row">
                            <span>Kasir:</span>
                            <span>Admin</span>
                        </div>
                    </div>
                    
                    <hr class="r-dash">
                    
                    <div style="margin:12px 0;">
                        <div style="font-size:13px;font-weight:700;margin-bottom:6px;text-transform:uppercase;" id="r_srv">-</div>
                        <div class="r-row">
                            <span id="r_qty">-</span>
                            <span id="r_price">Rp 0</span>
                        </div>
                    </div>
                    
                    <hr class="r-dash">
                    
                    <div style="margin:12px 0;line-height:1.6;">
                        <div class="r-row r-bold" style="font-size:15px;margin-bottom:6px;">
                            <span>TOTAL</span>
                            <span id="r_total">Rp 0</span>
                        </div>
                        <div class="r-row">
                            <span>Metode Bayar:</span>
                            <span style="text-transform:uppercase;" id="r_pay">-</span>
                        </div>
                        <div class="r-row">
                            <span>Status Lunas:</span>
                            <span class="r-bold" style="text-transform:uppercase;" id="r_paystatus">-</span>
                        </div>
                    </div>
                    
                    <hr class="r-dash">
                    
                    <div class="r-ctr" style="font-size:11px;line-height:1.6;margin-top:14px;">
                        <div>Terima kasih telah mempercayakan</div>
                        <div>cucian Anda kepada Laundrea.</div>
                        <div style="margin-top:8px;font-style:italic;">Simpan nota sebagai bukti pengambilan.</div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
'use strict';

/* ==========================================
   TANGGAL HARI INI
========================================== */
document.getElementById('currentDate').textContent = new Date().toLocaleDateString('id-ID', { 
    weekday: 'long', 
    day: 'numeric', 
    month: 'long', 
    year: 'numeric' 
});

/* ==========================================
   AUTHENTICATION CHECK
========================================== */
const token = localStorage.getItem('token');

if (!token) {
    window.location.href = '/login';
}

const H = { 
    'Authorization': `Bearer ${token}`, 
    'Accept': 'application/json', 
    'Content-Type': 'application/json' 
};

const HF = { 
    'Authorization': `Bearer ${token}`, 
    'Accept': 'application/json' 
};

try {
    const u = JSON.parse(localStorage.getItem('user') || '{}');
    if (u?.name) {
        document.getElementById('sbAdminName').textContent = u.name;
        document.getElementById('sbAvatar').textContent = u.name.substring(0, 2).toUpperCase();
    }
} catch (error) {
    console.error('Error parsing user data:', error);
}

/* ==========================================
   STATE VARIABLES (DATA PENYIMPANAN)
========================================== */
let custData = [];
let srvData = [];
let trxData = [];
let chartInst = null;
let chartType = 'bar';

/* ==========================================
   ACTIVITY LOG / NOTIFICATIONS
========================================== */
let acts = [];
try { 
    acts = JSON.parse(localStorage.getItem('la_acts') || '[]'); 
} catch(error) {
    console.error('Error parsing activity log:', error);
}

const ACT_ICONS = {
    order:    { icon: 'ti-file-plus',    bg: '#FEF0E4', clr: '#E07B39' },
    update:   { icon: 'ti-edit',         bg: '#EDE9FE', clr: '#7C3AED' },
    customer: { icon: 'ti-user-plus',    bg: '#E0F2FE', clr: '#0284C7' },
    service:  { icon: 'ti-stack-2',      bg: '#FEF3C7', clr: '#D97706' },
    delete:   { icon: 'ti-trash',        bg: '#FEE2E2', clr: '#DC2626' },
    success:  { icon: 'ti-circle-check', bg: '#DCFCE7', clr: '#16A34A' },
    info:     { icon: 'ti-info-circle',  bg: '#E0F2FE', clr: '#0284C7' },
};

function saveActs() { 
    localStorage.setItem('la_acts', JSON.stringify(acts.slice(0, 60))); 
}

function addActivity(type, msg) {
    const now = new Date();
    const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ', ' + now.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
    
    acts.unshift({ type: type, msg: msg, time: timeStr });
    saveActs();
    renderNotifPanel();
    updateBadge();
}

function renderNotifPanel() {
    const list = document.getElementById('notifList');
    const cnt  = document.getElementById('notifCount');
    
    cnt.textContent = acts.length + ' aktivitas';
    
    if (acts.length === 0) {
        list.innerHTML = `
        <div class="notif-empty">
            <i class="ti ti-bell-off" style="font-size:28px;display:block;margin-bottom:8px;opacity:.35;"></i>
            Belum ada aktivitas
        </div>`;
        return;
    }
    
    let htmlContent = '';
    
    acts.forEach(function(a) {
        const ic = ACT_ICONS[a.type] || ACT_ICONS.info;
        htmlContent += `
        <div class="notif-item">
            <div class="notif-icon" style="background:${ic.bg};color:${ic.clr};">
                <i class="ti ${ic.icon}"></i>
            </div>
            <div style="flex:1;">
                <div class="notif-msg">${a.msg}</div>
                <div class="notif-time">
                    <i class="ti ti-clock" style="font-size:10px;vertical-align:-1px;"></i> ${a.time}
                </div>
            </div>
        </div>`;
    });
    
    list.innerHTML = htmlContent;
}

function updateBadge() {
    const b = document.getElementById('notifBadge');
    
    if (acts.length > 0) { 
        b.style.display = 'flex'; 
        if (acts.length > 9) {
            b.textContent = '9+';
        } else {
            b.textContent = acts.length;
        }
    } else {
        b.style.display = 'none';
    }
}

function openNotif() { 
    document.getElementById('notifPanel').classList.add('open'); 
    document.getElementById('notifOverlay').classList.add('open'); 
}

function closeNotif() { 
    document.getElementById('notifPanel').classList.remove('open'); 
    document.getElementById('notifOverlay').classList.remove('open'); 
}

function clearActivities() { 
    acts = []; 
    saveActs(); 
    renderNotifPanel(); 
    updateBadge(); 
    toast('info', 'Aktivitas dibersihkan'); 
}

/* ==========================================
   TOAST NOTIFICATION COMPONENT
========================================== */
const TICONS = { 
    success: 'ti-circle-check', 
    error: 'ti-circle-x', 
    info: 'ti-info-circle', 
    warning: 'ti-alert-triangle' 
};

function toast(type, title, msg = '') {
    const el = document.createElement('div');
    el.className = 'toast';
    
    let htmlContent = `
        <div class="toast-ico ${type}">
            <i class="ti ${TICONS[type] || 'ti-bell'}"></i>
        </div>
        <div style="flex:1;">
            <div class="toast-ttl">${title}</div>`;
            
    if (msg) {
        htmlContent += `<div class="toast-msg">${msg}</div>`;
    }
    
    htmlContent += `
        </div>
        <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:var(--clr-muted);font-size:15px;padding:2px;line-height:1;">
            <i class="ti ti-x"></i>
        </button>`;
        
    el.innerHTML = htmlContent;
    document.getElementById('toastWrap').appendChild(el);
    
    setTimeout(function() { 
        el.classList.add('hiding'); 
        setTimeout(function() { 
            el.remove(); 
        }, 200); 
    }, 3500);
}

/* ==========================================
   TABS NAVIGATION LOGIC
========================================== */
const TAB_TITLES = { 
    beranda: 'Dashboard', 
    transaksi: 'Transaksi POS', 
    layanan: 'Katalog Layanan', 
    pelanggan: 'Data Pelanggan' 
};

function switchTab(tab) {
    const allTabs = ['beranda', 'transaksi', 'layanan', 'pelanggan'];
    
    allTabs.forEach(function(t) {
        const v = document.getElementById('view-' + t);
        const n = document.getElementById('nav-' + t);
        
        if (v) {
            v.style.display = 'none';
        }
        
        if (n) {
            n.classList.remove('active');
        }
    });
    
    const viewElement = document.getElementById('view-' + tab);
    const navElement = document.getElementById('nav-' + tab);
    
    if (viewElement) { 
        viewElement.style.display = 'block'; 
        viewElement.classList.remove('view-sec'); 
        
        // Memicu reflow browser agar animasi jalan
        void viewElement.offsetWidth; 
        
        viewElement.classList.add('view-sec'); 
    }
    
    if (navElement) {
        navElement.classList.add('active');
    }
    
    document.getElementById('topbarTitle').textContent = TAB_TITLES[tab] || tab;
}

/* ==========================================
   MODAL TOGGLERS
========================================== */
function openModal(id) { 
    document.getElementById(id).classList.add('open'); 
}

function closeModal(id) { 
    document.getElementById(id).classList.remove('open'); 
}

// Event listener agar modal tertutup saat klik overlay gelap di luarnya
document.querySelectorAll('.modal-ov').forEach(function(m) { 
    m.addEventListener('click', function(e) { 
        if (e.target === m) {
            m.classList.remove('open'); 
        }
    }); 
});

/* ==========================================
   FORMATTING HELPERS
========================================== */
function badge(statusString) {
    const mapBadge = {
        'antrian':      '<span class="badge b-antrian">Antrian</span>',
        'dicuci':       '<span class="badge b-dicuci">Dicuci</span>',
        'disetrika':    '<span class="badge b-disetrika">Setrika</span>',
        'siap diambil': '<span class="badge b-siap">Siap Ambil</span>',
        'diambil':      '<span class="badge b-selesai">Selesai</span>',
        'selesai':      '<span class="badge b-selesai">Selesai</span>',
    };
    
    if (mapBadge[statusString]) {
        return mapBadge[statusString];
    } else {
        return mapBadge['antrian'];
    }
}

function rp(value) { 
    let parseVal = parseFloat(value || 0);
    return 'Rp ' + parseVal.toLocaleString('id-ID'); 
}

function fDate(dateString) { 
    const dateObj = new Date(dateString);
    return dateObj.toLocaleDateString('id-ID', {
        day: '2-digit', 
        month: 'short', 
        year: '2-digit'
    }); 
}

function fDT(dateString) { 
    const dateObj = new Date(dateString); 
    const dStr = dateObj.toLocaleDateString('id-ID', {
        day: '2-digit', 
        month: 'short'
    });
    const tStr = dateObj.toLocaleTimeString('id-ID', {
        hour: '2-digit', 
        minute: '2-digit'
    });
    
    return dStr + ' ' + tStr; 
}

function cName(customerObj) { 
    if (!customerObj) {
        return 'Tanpa Nama'; 
    }
    
    if (customerObj.name) {
        return customerObj.name;
    } else if (customerObj.user && customerObj.user.name) {
        return customerObj.user.name;
    } else {
        return 'Tanpa Nama';
    }
}

/* ==========================================
   🌟 FUNGSI FALLBACK KUANTITAS / BERAT 🌟
   Jika API Laravel mengirimkan null/kosong/0
   maka kita akan otomatis hitung: Total / Harga Jasa
========================================== */
function fQty(trxItem) {
    // Langkah 1: Coba ambil nilai asli dari API Laravel 
    // (Laravel mungkin mengirimkan key: weight, qty, quantity, atau amount)
    let raw = null;
    
    if (trxItem) {
        if (trxItem.weight !== undefined && trxItem.weight !== null) raw = trxItem.weight;
        else if (trxItem.qty !== undefined && trxItem.qty !== null) raw = trxItem.qty;
        else if (trxItem.quantity !== undefined && trxItem.quantity !== null) raw = trxItem.quantity;
        else if (trxItem.amount !== undefined && trxItem.amount !== null) raw = trxItem.amount;
    }

    // Langkah 2: Logika Fallback Otomatis
    const totalPrice = parseFloat(trxItem?.total_price || 0);
    const servicePrice = parseFloat(trxItem?.service?.price || 0);

    // Kalau kosong, belum dikirim, atau dikirim "0" secara tidak sengaja oleh API, 
    // padahal ada harganya
    if (raw === null || raw === undefined || raw === '' || parseFloat(raw) === 0) {
        if (servicePrice > 0 && totalPrice > 0) {
            raw = totalPrice / servicePrice; 
        } else {
            return '-';
        }
    }

    const num = parseFloat(raw);
    
    if (isNaN(num)) {
        return '-';
    }

    // Langkah 3: Format angka yang cantik
    // Mengubah angka "2.500" menjadi "2.5" agar estetik
    let formattedNum = num;
    
    if (!Number.isInteger(num)) {
        formattedNum = num.toFixed(2).replace(/\.?0+$/, '');
    }

    // Ambil string satuan (Misal: Kg, Pcs)
    const unit = trxItem?.service?.unit || '';
    
    if (unit) {
        return formattedNum + ' ' + unit;
    } else {
        return formattedNum.toString();
    }
}

function toggleProof() {
    const methodSelect = document.getElementById('trx_pay');
    const proofBox = document.getElementById('proofBox');
    const proofInput = document.getElementById('trx_proof');
    
    const isTransfer = (methodSelect.value === 'transfer');
    
    proofInput.required = isTransfer;
    
    if (isTransfer) {
        proofBox.style.display = 'block';
    } else {
        proofBox.style.display = 'none';
    }
}

function updateQtyLabel() {
    const sel = document.getElementById('trx_srv');
    
    if (sel.selectedIndex < 0) return;
    
    const opt = sel.options[sel.selectedIndex];
    const unit = opt?.getAttribute('data-unit') || '';
    const lbl  = document.getElementById('lblQty');
    
    const unitLower = unit.toLowerCase();
    
    if (unitLower.includes('kg')) {
        lbl.textContent = 'Berat (Kg)';
    } else if (unitLower.includes('pcs')) {
        lbl.textContent = 'Jumlah (Pcs)';
    } else {
        lbl.textContent = 'Kuantitas';
    }
}

/* ==========================================
   PROGRESS TRACKER
========================================== */
function renderProgress(status) {
    const steps = [
        { key: 'antrian',      lbl: 'Antrian' },
        { key: 'dicuci',       lbl: 'Dicuci' },
        { key: 'disetrika',    lbl: 'Setrika' },
        { key: 'siap diambil', lbl: 'Siap' },
        { key: 'diambil',      lbl: 'Selesai' }
    ];
    
    const idx = steps.findIndex(function(s) {
        return s.key === status;
    });
    
    let htmlStr = '<div style="display:flex;align-items:flex-start;">';
    
    steps.forEach(function(s, i) {
        let st = '';
        
        if (i < idx) {
            st = 'done';
        } else if (i === idx) {
            st = 'active';
        } else {
            st = 'pending';
        }
        
        const bg  = (st === 'done') ? 'var(--clr-primary)' : 'white';
        const brd = (st !== 'pending') ? 'var(--clr-primary)' : '#E7E3DE';
        
        let clr = '';
        if (st === 'done') {
            clr = 'white';
        } else if (st === 'active') {
            clr = 'var(--clr-primary)';
        } else {
            clr = '#C4B8B0';
        }
        
        const lc  = (st !== 'pending') ? 'var(--clr-primary)' : '#C4B8B0';
        
        let lineLeft = '';
        if (i > 0) {
            const lineLeftBg = (i <= idx) ? 'var(--clr-primary)' : '#E7E3DE';
            lineLeft = `<div style="flex:1;height:2px;background:${lineLeftBg};"></div>`;
        }
        
        let iconOrNum = '';
        if (st === 'done') {
            iconOrNum = '<i class="ti ti-check" style="font-size:11px;"></i>';
        } else {
            iconOrNum = (i + 1).toString();
        }
        
        let lineRight = '';
        if (i < steps.length - 1) {
            const lineRightBg = (i < idx) ? 'var(--clr-primary)' : '#E7E3DE';
            lineRight = `<div style="flex:1;height:2px;background:${lineRightBg};"></div>`;
        }
        
        htmlStr += `
        <div style="display:flex;flex-direction:column;align-items:center;flex:1;">
            <div style="display:flex;align-items:center;width:100%;">
                ${lineLeft}
                <div style="width:26px;height:26px;border-radius:50%;border:2px solid ${brd};background:${bg};display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:${clr};flex-shrink:0;">
                    ${iconOrNum}
                </div>
                ${lineRight}
            </div>
            <div style="font-size:9px;font-weight:600;margin-top:4px;color:${lc};text-align:center;">${s.lbl}</div>
        </div>`;
    });
    
    htmlStr += '</div>';
    
    document.getElementById('progTracker').innerHTML = htmlStr;
}

/* ==========================================
   CHART.JS RENDERER
========================================== */
function renderChart(data, type) {
    if (type) {
        chartType = type;
    }
    
    const cnt = { 
        'antrian': 0, 
        'dicuci': 0, 
        'disetrika': 0, 
        'siap diambil': 0, 
        'diambil': 0 
    };
    
    data.forEach(function(t) { 
        if (cnt[t.status] !== undefined) {
            cnt[t.status]++; 
        }
    });
    
    const labels = ['Antrian', 'Dicuci', 'Setrika', 'Siap', 'Selesai'];
    const vals   = [
        cnt['antrian'], 
        cnt['dicuci'], 
        cnt['disetrika'], 
        cnt['siap diambil'], 
        cnt['diambil']
    ];
    
    const colors = ['#A3A3A3', '#38BDF8', '#A78BFA', '#2DD4BF', '#4ADE80'];
    
    if (chartInst) {
        chartInst.destroy();
    }
    
    const ctx = document.getElementById('mainChart').getContext('2d');
    
    let chartBgColors = [];
    let chartBorderWidth = 2;
    let chartBorderRadius = 5;
    
    if (chartType === 'doughnut') {
        chartBgColors = colors;
        chartBorderWidth = 0;
        chartBorderRadius = 0;
    } else {
        chartBgColors = colors.map(function(c) { return c + '33'; });
    }
    
    chartInst = new Chart(ctx, {
        type: chartType === 'doughnut' ? 'doughnut' : 'bar',
        data: { 
            labels: labels, 
            datasets: [{ 
                label: 'Pesanan', 
                data: vals, 
                backgroundColor: chartBgColors, 
                borderColor: colors, 
                borderWidth: chartBorderWidth, 
                borderRadius: chartBorderRadius 
            }] 
        },
        options: {
            responsive: true, 
            maintainAspectRatio: false,
            plugins: { 
                legend: { 
                    display: (chartType === 'doughnut'), 
                    position: 'right', 
                    labels: { 
                        font: { size: 11 }, 
                        padding: 10 
                    } 
                } 
            },
            scales: chartType === 'doughnut' ? {} : { 
                y: { 
                    beginAtZero: true, 
                    ticks: { stepSize: 1, font: { size: 10 } }, 
                    grid: { color: '#F5F2EE' } 
                }, 
                x: { 
                    grid: { display: false }, 
                    ticks: { font: { size: 10 } } 
                } 
            }
        }
    });
}

function updateStats() {
    let paidArr = [];
    
    trxData.forEach(function(t) {
        if (t.payment_status === 'paid' || t.payment_status === 'lunas') {
            paidArr.push(t);
        }
    });
    
    let paidRev = 0;
    paidArr.forEach(function(t) {
        paidRev += parseFloat(t.total_price || 0);
    });
    
    const r = document.getElementById('rep-paid');
    if (r) {
        r.textContent = rp(paidRev);
    }
    
    let doneCount = 0;
    let pendingCount = 0;
    
    trxData.forEach(function(t) {
        if (t.status === 'diambil') {
            doneCount++;
        } else {
            pendingCount++;
        }
    });
    
    const d = document.getElementById('rep-done');  
    if (d) {
        d.textContent = doneCount;
    }
    
    const p = document.getElementById('rep-pending');
    if (p) {
        p.textContent = pendingCount;
    }
}

/* ==========================================
   API FETCHES
========================================== */
async function fetchDashStats() {
    try {
        const response = await fetch('/api/dashboard-stats', { headers: H });
        const resJson = await response.json();
        
        if (resJson.success) {
            document.getElementById('stat-revenue').textContent = rp(resJson.data.revenue);
            document.getElementById('stat-transactions').textContent = resJson.data.transactions || 0;
            document.getElementById('stat-customers').textContent = resJson.data.customers || 0;
        }
    } catch (error) {
        console.error('Error fetching dashboard stats:', error);
    }
}

async function fetchSrvs() {
    try {
        const response = await fetch('/api/services', { headers: H });
        const resJson = await response.json();
        
        srvData = resJson.data || [];
        
        const tb = document.getElementById('srvTBody');
        
        if (srvData.length === 0) { 
            tb.innerHTML = `
            <tr class="empty-row">
                <td colspan="4">Belum ada layanan.</td>
            </tr>`; 
            return; 
        }
        
        let htmlStr = '';
        srvData.forEach(function(s) {
            const sName = s.service_name || '-';
            const sPrice = rp(s.price);
            const sUnit = s.unit || '-';
            
            htmlStr += `
            <tr>
                <td>
                    <div style="font-weight:600;">${sName}</div>
                </td>
                <td>
                    <div style="font-weight:700;">${sPrice}</div>
                </td>
                <td>
                    <span style="font-size:10px;font-weight:700;color:var(--clr-muted);background:#F5F2EE;padding:3px 8px;border-radius:5px;text-transform:uppercase;">
                        ${sUnit}
                    </span>
                </td>
                <td>
                    <div class="tbl-actions">
                        <button onclick="editSrv(${s.id})" class="btn btn-edit btn-sm btn-icon">
                            <i class="ti ti-pencil" style="font-size:13px;"></i>
                        </button>
                        <button onclick="delSrv(${s.id})" class="btn btn-del btn-sm btn-icon">
                            <i class="ti ti-trash" style="font-size:13px;"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
        });
        
        tb.innerHTML = htmlStr;
        
    } catch (error) { 
        toast('error', 'Gagal memuat layanan'); 
        console.error('Fetch Service Error:', error);
    }
}

async function fetchCusts() {
    try {
        const searchInput = document.getElementById('srchCust').value;
        let url = '/api/customers';
        
        if (searchInput) {
            url += `?search=${encodeURIComponent(searchInput)}`;
        }
        
        const response = await fetch(url, { headers: H });
        const resJson = await response.json();
        
        custData = resJson.data || [];
        
        const tb = document.getElementById('custTBody');
        
        if (custData.length === 0) { 
            tb.innerHTML = `
            <tr class="empty-row">
                <td colspan="5">Tidak ada pelanggan.</td>
            </tr>`; 
            return; 
        }
        
        let htmlStr = '';
        
        custData.forEach(function(c) {
            const nm = cName(c);
            const em = c.user?.email || '-';
            
            let waLink = '#';
            if (c.phone) {
                waLink = `https://wa.me/${c.phone.replace(/\D/g, '')}`;
            }
            
            // 🌟 TRX PERBAIKAN: Hanya hitung yang berstatus Selesai (diambil) 🌟
            let trxCount = 0;
            trxData.forEach(function(t) {
                if (t.customer_id === c.id) {
                    if (t.status === 'diambil' || t.status === 'selesai') {
                        trxCount++;
                    }
                }
            });
            
            const addr = c.address || '-';
            
            htmlStr += `
            <tr>
                <td>
                    <div style="font-weight:600;">${nm}</div>
                    <div style="font-size:11px;color:var(--clr-muted);margin-top:2px;">${em}</div>
                </td>
                <td>
                    <a href="${waLink}" target="_blank" style="display:inline-flex;align-items:center;gap:5px;padding:3px 8px;background:#F0FDF4;color:#15803D;border-radius:6px;font-size:11px;font-weight:600;text-decoration:none;">
                        <i class="ti ti-brand-whatsapp" style="font-size:13px;"></i> ${c.phone || '-'}
                    </a>
                </td>
                <td style="font-size:12px;color:var(--clr-muted);max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    ${addr}
                </td>
                <td style="font-size:12px;font-weight:700;color:var(--clr-primary);">
                    ${trxCount} trx
                </td>
                <td>
                    <div class="tbl-actions">
                        <button onclick="editCust(${c.id})" class="btn btn-edit btn-sm btn-icon">
                            <i class="ti ti-pencil" style="font-size:13px;"></i>
                        </button>
                        <button onclick="delCust(${c.id})" class="btn btn-del btn-sm btn-icon">
                            <i class="ti ti-trash" style="font-size:13px;"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
        });
        
        tb.innerHTML = htmlStr;
        
    } catch (error) { 
        toast('error', 'Gagal memuat pelanggan'); 
        console.error('Fetch Customer Error:', error);
    }
}

async function fetchTrx() {
    try {
        const sf = document.getElementById('filterStatus').value;
        const df = document.getElementById('filterDate').value;
        
        let url = '/api/transactions';
        const params = new URLSearchParams();
        
        if (sf) params.append('status', sf);
        if (df) params.append('date', df);
        
        if (params.toString()) {
            url += '?' + params.toString();
        }
        
        const response = await fetch(url, { headers: H });
        const resJson = await response.json();
        
        trxData = resJson.data || [];
        
        renderChart(trxData);
        
        let pendingCount = 0;
        trxData.forEach(function(t) {
            if (t.status !== 'diambil') {
                pendingCount++;
            }
        });
        
        document.getElementById('stat-active').textContent = pendingCount;
        
        updateStats();
        
        // Antrian dot
        let hasAntrian = false;
        trxData.forEach(function(t) {
            if (t.status === 'antrian') {
                hasAntrian = true;
            }
        });
        
        if (hasAntrian) {
            document.getElementById('transaksiDot').style.display = 'block';
        } else {
            document.getElementById('transaksiDot').style.display = 'none';
        }
        
        // Popular services logic
        const srvCountObj = {};
        trxData.forEach(function(t) {
            const n = t.service?.service_name || 'Dihapus'; 
            if (!srvCountObj[n]) {
                srvCountObj[n] = 0;
            }
            srvCountObj[n] += 1; 
        });
        
        // Sorting
        const sortedEntries = Object.entries(srvCountObj).sort(function(a, b) {
            return b[1] - a[1];
        }).slice(0, 5);
        
        const pList = document.getElementById('popularList');
        const barClr = ['var(--clr-primary)', '#38BDF8', '#A78BFA', '#4ADE80', '#F59E0B'];
        
        if (pList) {
            if (sortedEntries.length > 0) {
                let popHtml = '';
                sortedEntries.forEach(function(itemArr, i) {
                    const svcName = itemArr[0];
                    const svcCount = itemArr[1];
                    popHtml += `
                    <div style="display:flex;align-items:center;gap:9px;">
                        <div style="width:7px;height:7px;border-radius:50%;background:${barClr[i]};flex-shrink:0;"></div>
                        <span style="flex:1;font-size:12px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${svcName}</span>
                        <span style="font-size:11px;font-weight:700;color:var(--clr-muted);">${svcCount} trx</span>
                    </div>`;
                });
                pList.innerHTML = popHtml;
            } else {
                pList.innerHTML = '<p style="font-size:12px;color:var(--clr-muted);">Belum ada data.</p>';
            }
        }
        
        renderTrxTable(trxData);
        renderRecentTable(trxData);
        
        // Memanggil fetchCusts jika pengguna mereload trx, supaya data count sinkron
        if (document.getElementById('view-pelanggan').style.display !== 'none') {
            fetchCusts();
        }
        
    } catch (error) { 
        toast('error', 'Gagal memuat transaksi'); 
        console.error('Fetch Transaction Error:', error);
    }
}

function renderTrxTable(data) {
    const tb = document.getElementById('trxTBody');
    
    if (data.length === 0) { 
        tb.innerHTML = `
        <tr class="empty-row">
            <td colspan="6">Belum ada pesanan.</td>
        </tr>`; 
        return; 
    }
    
    let htmlStr = '';
    
    data.forEach(function(item) {
        const inv = item.invoice_code || '-';
        const date = fDT(item.created_at);
        const custName = cName(item.customer);
        const svcName = item.service?.service_name || '-';
        const qty = fQty(item);
        const total = rp(item.total_price);
        const method = item.payment_method || '-';
        const statusBadge = badge(item.status);
        
        htmlStr += `
        <tr class="clickable" onclick="viewDetail(${item.id})">
            <td>
                <div style="font-weight:600;font-size:12px;">${inv}</div>
                <div style="font-size:11px;color:var(--clr-muted);margin-top:1px;">${date}</div>
            </td>
            <td style="font-weight:500;">
                ${custName}
            </td>
            <td>
                <div style="font-size:12px;font-weight:600;">${svcName}</div>
                <div style="font-size:11px;color:var(--clr-muted);">${qty}</div>
            </td>
            <td>
                <div style="font-weight:700;">${total}</div>
            </td>
            <td>
                <span style="font-size:10px;font-weight:600;text-transform:uppercase;color:var(--clr-muted);">
                    ${method}
                </span>
            </td>
            <td style="text-align:center;">
                ${statusBadge}
            </td>
        </tr>`;
    });
    
    tb.innerHTML = htmlStr;
}

function renderRecentTable(data) {
    const tb = document.getElementById('recentTBody');
    
    if (data.length === 0) { 
        tb.innerHTML = `
        <tr class="empty-row">
            <td colspan="5">Belum ada data.</td>
        </tr>`; 
        return; 
    }
    
    let htmlStr = '';
    
    const sliceData = data.slice(0, 5);
    
    sliceData.forEach(function(item) {
        const custName = cName(item.customer);
        const inv = item.invoice_code || '-';
        const svcName = item.service?.service_name || '-';
        const total = rp(item.total_price);
        const statusBadge = badge(item.status);
        
        htmlStr += `
        <tr class="clickable" onclick="switchTab('transaksi');setTimeout(()=>viewDetail(${item.id}),100);">
            <td style="font-weight:600;">${custName}</td>
            <td style="font-size:12px;color:var(--clr-muted);">${inv}</td>
            <td style="font-size:12px;">${svcName}</td>
            <td style="font-weight:700;">${total}</td>
            <td style="text-align:center;">${statusBadge}</td>
        </tr>`;
    });
    
    tb.innerHTML = htmlStr;
}

function filterTrxLocal() {
    const inputElement = document.getElementById('srchTrx');
    const q = inputElement.value.toLowerCase();
    
    if (!q) { 
        renderTrxTable(trxData); 
        return; 
    }
    
    let filteredArr = [];
    
    trxData.forEach(function(t) {
        const cNameLower = cName(t.customer).toLowerCase();
        const invLower = (t.invoice_code || '').toLowerCase();
        
        if (cNameLower.includes(q) || invLower.includes(q)) {
            filteredArr.push(t);
        }
    });
    
    renderTrxTable(filteredArr);
}

function exportCSV() {
    if (trxData.length === 0) { 
        toast('warning', 'Tidak ada data'); 
        return; 
    }
    
    let csv = 'Invoice,Tanggal,Pelanggan,Layanan,Kuantitas,Total,Metode,Status\n';
    
    trxData.forEach(function(t) { 
        const inv = t.invoice_code || '-';
        const date = fDate(t.created_at);
        const cust = cName(t.customer);
        const srv = t.service?.service_name || '-';
        const qty = fQty(t);
        const tot = t.total_price || 0;
        const meth = t.payment_method || '-';
        const stat = t.status || '-';
        
        csv += `${inv},${date},${cust},${srv},${qty},${tot},${meth},${stat}\n`; 
    });
    
    const a = document.createElement('a');
    a.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
    
    const dateStr = new Date().toLocaleDateString('id-ID');
    a.download = `Laundrea_Export_${dateStr}.csv`;
    
    document.body.appendChild(a); 
    a.click(); 
    document.body.removeChild(a);
    
    toast('success', 'CSV berhasil diunduh');
}

/* ==========================================
   DETAIL TRANSAKSI & CETAK STRUK
========================================== */
window.viewDetail = function(id) {
    let t = null;
    
    trxData.forEach(function(item) {
        if (item.id === id) {
            t = item;
        }
    });
    
    if (!t) return;

    document.getElementById('detBadge').innerHTML = badge(t.status);
    document.getElementById('det_trx_id').value = t.id;
    document.getElementById('det_status').value = t.status;
    document.getElementById('det_photo').value = '';
    
    renderProgress(t.status);

    /* ── STRUK THERMAL DATA BINDING ── */
    const nm  = cName(t.customer);
    const srv = t.service?.service_name || 'Layanan';
    const unt = t.service?.unit || '';
    const prc = t.service?.price || 0;
    const tot = t.total_price || 0;
    const qty = fQty(t);
    const d   = new Date(t.created_at);
    
    const dateFormatted = d.toLocaleDateString('id-ID') + ' ' + d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    
    document.getElementById('r_date').textContent  = dateFormatted;
    document.getElementById('r_inv').textContent   = t.invoice_code || '-';
    document.getElementById('r_cust').textContent  = nm;
    document.getElementById('r_srv').textContent   = srv.toUpperCase();
    
    // Perbaikan Baris Harga (Kuantitas x Harga Satuan)
    document.getElementById('r_qty').textContent   = `${qty} x ${rp(prc)}`;
    document.getElementById('r_price').textContent = rp(tot);
    
    document.getElementById('r_total').textContent = rp(tot);
    document.getElementById('r_pay').textContent   = t.payment_method || '-';
    document.getElementById('r_paystatus').textContent = t.payment_status || 'LUNAS';

    // Opsional: Coba tampilkan raw response JSON di Debug panel jika ada
    try { 
        const debugElement = document.getElementById('debugJSON');
        if (debugElement) {
            debugElement.textContent = JSON.stringify(t, null, 2); 
        }
    } catch(err) {
        console.error('Debug UI error', err);
    }

    /* ── 🌟 FITUR MUNCULKAN GALERI FOTO UPDATE STATUS 🌟 ── */
    // Menambahkan timestamp ke src gambar supaya gambar selalu ter-refresh tanpa cache
    const cacheBuster = new Date().getTime();
    
    function buildImgSrc(rawPath) {
        if (!rawPath) return null;
        
        let pathString = String(rawPath).trim();
        
        if (pathString.startsWith('http://') || pathString.startsWith('https://')) {
            return pathString + "?v=" + cacheBuster;
        }
        
        // Membersihkan awalan folder agar seragam
        pathString = pathString.replace(/^\/+/, '').replace(/^storage\//, '');
        return '/storage/' + pathString + "?v=" + cacheBuster;
    }

    // List key foto yang bisa direspon oleh backend. 
    // Kita tambahkan banyak fallback key untuk memastikan fotonya tertangkap!
    const slots = [
        { key: 'payment_proof',   lbl: 'Bukti Transfer' },
        { key: 'clothes_photo',   lbl: 'Kondisi Masuk' },
        { key: 'photo_dicuci',    lbl: 'Saat Dicuci' },
        { key: 'photo_disetrika', lbl: 'Saat Disetrika' },
        { key: 'photo_siap',      lbl: 'Siap Diambil' },
        { key: 'photo_diambil',   lbl: 'Telah Selesai' },
        // Fallback tambahan jika backend menyimpannya sebagai generic "photo" atau history array
        { key: 'photo',           lbl: 'Update Terakhir' }
    ];

    const gal = document.getElementById('galTracking');
    let photosHTML = '';
    let hasPhoto = false;

    // Track which keys we already showed so we don't duplicate fallback
    let showedUrls = [];

    slots.forEach(function(slot) {
        const imgSrc = buildImgSrc(t[slot.key]);
        
        if (!imgSrc) return;
        
        // Cegah duplikat gambar (misal photo dan photo_diambil URL nya sama)
        const baseUrl = imgSrc.split('?v=')[0];
        if (showedUrls.includes(baseUrl)) return;
        
        showedUrls.push(baseUrl);
        hasPhoto = true;
        
        photosHTML += `
        <div class="gal-item">
            <div class="gal-lbl">${slot.lbl}</div>
            <a href="${imgSrc}" target="_blank">
                <img src="${imgSrc}" alt="${slot.lbl}" loading="lazy"
                     onerror="this.closest('a').outerHTML='<div style=&quot;height:85px;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:4px;background:#FAFAF8;font-size:10px;color:var(--clr-muted);&quot;><i class=&quot;ti ti-photo-off&quot; style=&quot;font-size:20px;&quot;></i><span>Gagal dimuat</span></div>'">
            </a>
        </div>`;
    });

    if (hasPhoto) {
        gal.innerHTML = '<div class="gal-grid">' + photosHTML + '</div>';
    } else {
        gal.innerHTML = `
        <div class="gal-empty">
            <i class="ti ti-photo-off" style="font-size:24px;display:block;margin-bottom:6px;"></i>
            Belum ada foto progress
        </div>`;
    }

    openModal('detailModal');
};

// Fitur klik ganda judul galeri untuk menampilkan JSON (Debug Tool)
document.addEventListener('dblclick', function(e) {
    const targetElement = e.target;
    const closestGalTracking = targetElement.closest('#galTracking');
    
    if (closestGalTracking) {
        const prevElement = closestGalTracking.previousElementSibling;
        if (prevElement && prevElement.textContent && prevElement.textContent.includes('Galeri')) {
            const dp = document.getElementById('debugPanel');
            if (dp) {
                if (dp.style.display === 'none') {
                    dp.style.display = 'block';
                } else {
                    dp.style.display = 'none';
                }
            }
        }
    }
});

/* ==========================================
   SERVICE MODAL
========================================== */
function openSrvModal() {
    document.getElementById('srvForm').reset();
    document.getElementById('srv_id').value = '';
    document.getElementById('srvModalTitle').textContent = 'Tambah Layanan';
    openModal('srvModal');
}

window.editSrv = function(id) {
    let s = null;
    
    srvData.forEach(function(x) {
        if (x.id === id) {
            s = x;
        }
    });
    
    if (!s) return;
    
    document.getElementById('srv_id').value = s.id;
    document.getElementById('srv_name').value = s.service_name || '';
    
    const sUnit = (s.unit || '').toLowerCase();
    let srvType = 'satuan';
    if (sUnit.includes('kg')) {
        srvType = 'kiloan';
    }
    document.getElementById('srv_type').value = srvType;
    
    document.getElementById('srv_price').value = s.price || 0;
    document.getElementById('srvModalTitle').textContent = 'Edit Layanan';
    
    openModal('srvModal');
};

/* ==========================================
   CUSTOMER MODAL
========================================== */
function openCustModal() {
    document.getElementById('custForm').reset();
    document.getElementById('cust_id').value = '';
    document.getElementById('custModalTitle').textContent = 'Registrasi Pelanggan';
    
    document.getElementById('authFields').style.display = 'block';
    document.getElementById('cust_email').required = true;
    document.getElementById('cust_pass').required = true;
    
    openModal('custModal');
}

window.editCust = function(id) {
    let c = null;
    
    custData.forEach(function(x) {
        if (x.id === id) {
            c = x;
        }
    });
    
    if (!c) return;
    
    document.getElementById('cust_id').value  = c.id;
    document.getElementById('cust_name').value = cName(c);
    document.getElementById('cust_phone').value = c.phone || '';
    document.getElementById('cust_addr').value  = c.address || '';
    document.getElementById('custModalTitle').textContent = 'Edit Pelanggan';
    
    document.getElementById('authFields').style.display = 'none';
    document.getElementById('cust_email').required = false;
    document.getElementById('cust_pass').required  = false;
    
    openModal('custModal');
};

/* ==========================================
   TRX MODAL (TAMBAH TRANSAKSI BARU)
========================================== */
function openTrxModal() {
    document.getElementById('trxForm').reset();
    
    let custOptions = '<option value="">-- Pilih Pelanggan --</option>';
    custData.forEach(function(c) {
        const namaText = cName(c);
        const hpText = c.phone || '-';
        custOptions += `<option value="${c.id}">${namaText} (${hpText})</option>`;
    });
    document.getElementById('trx_cust').innerHTML = custOptions;
        
    let srvOptions = '<option value="" data-unit="">-- Pilih Layanan --</option>';
    srvData.forEach(function(s) {
        const hargaText = rp(s.price);
        const unitText = s.unit || '-';
        srvOptions += `<option value="${s.id}" data-unit="${s.unit || ''}">${s.service_name} — ${hargaText}/${unitText}</option>`;
    });
    document.getElementById('trx_srv').innerHTML = srvOptions;
        
    document.getElementById('lblQty').textContent = 'Kuantitas';
    document.getElementById('proofBox').style.display = 'none';
    
    openModal('trxModal');
}

/* ==========================================
   FORM SUBMITS (AKSI PENYIMPANAN DATA)
========================================== */

// ── FORM: SIMPAN LAYANAN ──
document.getElementById('srvForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btnSaveSrv');
    btn.textContent = 'Menyimpan...'; 
    btn.disabled = true;
    
    const id = document.getElementById('srv_id').value;
    const nm = document.getElementById('srv_name').value;
    const sType = document.getElementById('srv_type').value;
    const sPrice = document.getElementById('srv_price').value;
    
    let unit = 'Pcs';
    if (sType === 'kiloan') {
        unit = 'Kg';
    }
    
    let url = '/api/services';
    let methodType = 'POST';
    
    if (id) {
        url = `/api/services/${id}`;
        methodType = 'PUT';
    }
    
    const payload = { 
        service_name: nm, 
        price: sPrice, 
        unit: unit 
    };
    
    try {
        const response = await fetch(url, {
            method: methodType, 
            headers: H,
            body: JSON.stringify(payload)
        });
        
        const resJson = await response.json();
        
        if (resJson.success || resJson.data) {
            closeModal('srvModal'); 
            fetchSrvs();
            
            if (id) {
                toast('success', 'Layanan diperbarui');
                addActivity('service', `Memperbarui layanan: ${nm}`);
            } else {
                toast('success', 'Layanan ditambahkan');
                addActivity('service', `Menambah layanan: ${nm}`);
            }
            
        } else {
            throw new Error(resJson.message || 'Operasi layanan gagal');
        }
        
    } catch(err) { 
        toast('error', 'Gagal menyimpan layanan', err.message); 
        console.error('Service save err:', err);
    } finally { 
        btn.textContent = 'Simpan'; 
        btn.disabled = false; 
    }
});

// ── FORM: SIMPAN PELANGGAN ──
document.getElementById('custForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btnSaveCust');
    btn.textContent = 'Menyimpan...'; 
    btn.disabled = true;
    
    const id = document.getElementById('cust_id').value;
    const nm = document.getElementById('cust_name').value;
    const ph = document.getElementById('cust_phone').value;
    const ad = document.getElementById('cust_addr').value;
    
    let payload = { 
        name: nm, 
        phone: ph, 
        address: ad 
    };
    
    if (!id) { 
        payload.email = document.getElementById('cust_email').value; 
        payload.password = document.getElementById('cust_pass').value; 
    }
    
    let url = '/api/customers';
    let methodType = 'POST';
    
    if (id) {
        url = `/api/customers/${id}`;
        methodType = 'PUT';
    }
    
    try {
        const response = await fetch(url, {
            method: methodType, 
            headers: H, 
            body: JSON.stringify(payload)
        });
        
        const resJson = await response.json();
        
        if (resJson.success || resJson.data) {
            closeModal('custModal'); 
            fetchCusts(); 
            fetchDashStats();
            
            if (id) {
                toast('success', 'Pelanggan berhasil diperbarui');
                addActivity('customer', `Update pelanggan: ${nm}`);
            } else {
                toast('success', 'Pelanggan baru terdaftar');
                addActivity('customer', `Daftarkan pelanggan: ${nm}`);
            }
            
        } else {
            throw new Error(resJson.message || 'Gagal menyimpan pelanggan');
        }
        
    } catch(err) { 
        toast('error', 'Gagal simpan', err.message); 
        console.error('Customer save err:', err);
    } finally { 
        btn.textContent = 'Simpan'; 
        btn.disabled = false; 
    }
});

// ── FORM: SIMPAN TRANSAKSI BARU ──
document.getElementById('trxForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btnSaveTrx');
    btn.innerHTML = '<i class="ti ti-loader" style="font-size:12px;animation:spin 1s linear infinite;"></i> Memproses...';
    btn.disabled = true;
    
    const cId = document.getElementById('trx_cust').value;
    const sId = document.getElementById('trx_srv').value;
    const qty = document.getElementById('trx_qty').value;
    const pMt = document.getElementById('trx_pay').value;
    
    const fd = new FormData();
    fd.append('customer_id', cId);
    fd.append('service_id',  sId);
    fd.append('weight',      qty);
    
    // Fallback append agar aman untuk versi Laravel yang berbeda
    fd.append('qty',         qty);
    fd.append('quantity',    qty);
    
    fd.append('payment_method', pMt);
    
    const cp = document.getElementById('trx_photo').files[0]; 
    if (cp) {
        fd.append('clothes_photo', cp);
    }
    
    if (pMt === 'transfer') {
        const pr = document.getElementById('trx_proof').files[0]; 
        if (pr) {
            fd.append('payment_proof', pr);
        }
    }
    
    const selEl = document.getElementById('trx_cust');
    let custLbl = '';
    
    if (selEl.selectedIndex >= 0) {
        custLbl = selEl.options[selEl.selectedIndex].text;
    }
    
    try {
        const response = await fetch('/api/transactions', { 
            method: 'POST', 
            headers: HF, 
            body: fd 
        });
        
        const resJson = await response.json();
        
        if (resJson.success || resJson.data) {
            closeModal('trxModal'); 
            fetchTrx(); 
            fetchDashStats();
            
            const inv = resJson.data?.invoice_code || '';
            toast('success', 'Nota berhasil dibuat', inv);
            
            let actString = 'Pesanan baru: ';
            if (inv) actString += inv; else actString += 'Nota';
            actString += ' — ' + custLbl;
            
            addActivity('order', actString);
            
        } else {
            throw new Error(resJson.message || 'Gagal menyimpan transaksi');
        }
        
    } catch(err) { 
        toast('error', 'Gagal buat nota', err.message); 
        console.error('Trx save err:', err);
    } finally { 
        btn.innerHTML = '<i class="ti ti-device-floppy" style="font-size:12px;"></i> Simpan Order'; 
        btn.disabled = false; 
    }
});

// ── FORM: 🌟 UPDATE STATUS PROGRESS 🌟 ──
document.getElementById('statusForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btnUpdateStatus');
    const oldH = btn.innerHTML;
    
    btn.textContent = 'Menyimpan...'; 
    btn.disabled = true;
    
    const id = document.getElementById('det_trx_id').value;
    const newStatus = document.getElementById('det_status').value;
    const photo = document.getElementById('det_photo').files[0];
    
    const fd = new FormData();
    fd.append('_method', 'PATCH');
    fd.append('status', newStatus);
    
    // Perbaikan Logika Upload Foto: 
    // Menyertakan key generic "photo" DAN key spesifik agar lebih aman
    if (photo) {
        fd.append('photo', photo);
        
        if (newStatus === 'dicuci') {
            fd.append('photo_dicuci', photo);
        } else if (newStatus === 'disetrika') {
            fd.append('photo_disetrika', photo);
        } else if (newStatus === 'siap diambil') {
            fd.append('photo_siap', photo);
        } else if (newStatus === 'diambil') {
            fd.append('photo_diambil', photo);
        }
    }
    
    try {
        const response = await fetch(`/api/transactions/${id}/status`, { 
            method: 'POST', 
            headers: HF, 
            body: fd 
        });
        
        const resJson = await response.json();
        
        if (resJson.success || resJson.data) {
            toast('success', 'Status diperbarui', `→ ${newStatus}`);
            
            let actMsg = `Status pesanan #${id} → "${newStatus}"`;
            if (photo) actMsg += ' (+ foto)';
            addActivity('update', actMsg);
            
            // JANGAN TUTUP MODAL SECARA OTOMATIS AGAR FOTO BISA LANGSUNG TERLIHAT.
            // Kita render ulang detailnya
            fetchTrx().then(function() {
                // panggil view detail lagi untuk mereload UI foto dengan cache buster baru
                viewDetail(parseInt(id));
            });
            
        } else {
            throw new Error(resJson.message || 'Gagal mengubah status');
        }
        
    } catch(err) { 
        toast('error', 'Gagal update status', err.message); 
        console.error('Update status err:', err);
    } finally { 
        btn.innerHTML = oldH; 
        btn.disabled = false; 
    }
});

/* ==========================================
   DELETE FUNCTIONS
========================================== */
window.delSrv = function(id) {
    let nm = 'layanan ini';
    
    srvData.forEach(function(s) {
        if (s.id === id) {
            nm = s.service_name || nm;
        }
    });
    
    Swal.fire({ 
        title: 'Hapus Layanan?', 
        text: `"${nm}" akan dihapus permanen dari sistem.`, 
        icon: 'warning', 
        showCancelButton: true, 
        confirmButtonColor: '#DC2626', 
        cancelButtonText: 'Batal', 
        confirmButtonText: 'Ya, Hapus' 
    }).then(async function(r) {
        if (r.isConfirmed) {
            try {
                await fetch(`/api/services/${id}`, { method: 'DELETE', headers: H });
                fetchSrvs(); 
                toast('success', 'Layanan berhasil dihapus');
                addActivity('delete', `Hapus layanan: ${nm}`);
            } catch(e) {
                toast('error', 'Gagal menghapus layanan');
            }
        }
    });
};

window.delCust = function(id) {
    let c = null;
    
    custData.forEach(function(x) {
        if (x.id === id) c = x;
    });
    
    const nm = cName(c);
    
    Swal.fire({ 
        title: 'Hapus Pelanggan?', 
        text: `Pelanggan "${nm}" beserta akses loginnya akan dihapus.`, 
        icon: 'warning', 
        showCancelButton: true, 
        confirmButtonColor: '#DC2626', 
        cancelButtonText: 'Batal', 
        confirmButtonText: 'Ya, Hapus' 
    }).then(async function(r) {
        if (r.isConfirmed) {
            try {
                await fetch(`/api/customers/${id}`, { method: 'DELETE', headers: H });
                fetchCusts(); 
                fetchDashStats();
                toast('success', 'Pelanggan berhasil dihapus');
                addActivity('delete', `Hapus pelanggan: ${nm}`);
            } catch (e) {
                toast('error', 'Gagal menghapus pelanggan');
            }
        }
    });
};

/* ==========================================
   LOGOUT & REFRESH UTILITIES
========================================== */
async function logout() {
    try { 
        await fetch('/api/logout', { method: 'POST', headers: H }); 
    } catch(err) {
        console.error('Logout request failed', err);
    }
    
    localStorage.clear(); 
    window.location.href = '/login';
}

function doRefresh() {
    fetchDashStats(); 
    fetchTrx(); 
    fetchCusts();
    toast('info', 'Semua data terbaru berhasil dimuat');
}

/* ==========================================
   APP INITIALIZATION
========================================== */
renderNotifPanel();
updateBadge();
fetchDashStats();
fetchSrvs();
fetchCusts();
fetchTrx();

</script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundrea — Admin Panel</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <style>
        /* ==========================================
           FONTS IMPORT
        ========================================== */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&display=swap');

        /* ==========================================
           ROOT VARIABLES & COLOR PALETTE
        ========================================== */
        :root {
            /* Primary Colors */
            --clr-primary: #E07B39;
            --clr-primary-dark: #C45E20;
            --clr-primary-bg: #FEF3EA;
            --clr-primary-subtle: #FFF8F3;
            
            /* Sidebar Colors */
            --clr-sb-bg: #FFFBF7;
            --clr-sb-border: #F0E8DF;
            --clr-sb-item: #9C8F84;
            --clr-sb-active: #E07B39;
            --clr-sb-active-bg: #FEF0E4;
            --clr-sb-hover: #FDF6F0;
            
            /* Background & Card Colors */
            --clr-bg: #F7F4F0;
            --clr-card: #FFFFFF;
            --clr-border: #EDE9E3;
            
            /* Text Colors */
            --clr-text: #1E1A17;
            --clr-muted: #7A6F68;
            
            /* Status Colors: Success */
            --clr-success: #16A34A;
            --clr-success-bg: #DCFCE7;
            
            /* Status Colors: Warning */
            --clr-warning: #D97706;
            --clr-warning-bg: #FEF3C7;
            
            /* Status Colors: Info */
            --clr-info: #0284C7;
            --clr-info-bg: #E0F2FE;
            
            /* Status Colors: Danger */
            --clr-danger: #DC2626;
            --clr-danger-bg: #FEE2E2;
        }

        /* ==========================================
           GLOBAL RESET
        ========================================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        *::before {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        html {
            height: 100%;
            overflow: hidden;
        }
        
        body {
            height: 100%;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            background: var(--clr-bg);
            color: var(--clr-text);
        }

        /* ==========================================
           CUSTOM SCROLLBAR
        ========================================== */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #D6CDC5;
            border-radius: 99px;
        }

        /* ==========================================
           LAYOUT ROOT
        ========================================== */
        .app-root {
            display: flex;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        /* ==========================================
           SIDEBAR STYLES
        ========================================== */
        .sidebar {
            width: 220px;
            min-width: 220px;
            max-width: 220px;
            height: 100vh;
            background: var(--clr-sb-bg);
            border-right: 1px solid var(--clr-sb-border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            flex-shrink: 0;
            z-index: 10;
        }
        
        .sb-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 18px 16px;
            border-bottom: 1px solid var(--clr-sb-border);
            flex-shrink: 0;
        }
        
        .sb-logo-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, #E07B39, #F0A565);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(224, 123, 57, 0.28);
        }
        
        .sb-logo-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--clr-text);
        }
        
        .sb-logo-sub {
            font-size: 10px;
            color: var(--clr-sb-item);
            margin-top: 1px;
        }
        
        .sb-nav {
            flex: 1;
            overflow-y: auto;
            padding: 12px 10px;
        }
        
        .sb-section {
            font-size: 9px;
            font-weight: 700;
            color: #C4B8B0;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 8px 8px 4px;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.15s;
            color: var(--clr-sb-item);
            font-size: 12.5px;
            font-weight: 500;
            margin-bottom: 2px;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }
        
        .nav-item:hover {
            background: var(--clr-sb-hover);
            color: var(--clr-text);
        }
        
        .nav-item.active {
            background: var(--clr-sb-active-bg);
            color: var(--clr-sb-active);
            font-weight: 600;
        }
        
        .nav-item .ti {
            font-size: 15px;
            flex-shrink: 0;
        }
        
        .nav-dot {
            margin-left: auto;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--clr-primary);
            animation: blink 2s infinite;
        }
        
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.35; }
            100% { opacity: 1; }
        }

        .sb-foot {
            padding: 10px;
            border-top: 1px solid var(--clr-sb-border);
            flex-shrink: 0;
        }
        
        .sb-user {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 10px;
            border-radius: 8px;
            background: var(--clr-primary-bg);
            border: 1px solid rgba(224, 123, 57, 0.15);
            margin-bottom: 6px;
        }
        
        .sb-avatar {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--clr-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 11px;
            color: white;
            flex-shrink: 0;
        }
        
        .sb-uname {
            font-size: 12px;
            font-weight: 600;
            color: var(--clr-text);
        }
        
        .sb-urole {
            font-size: 10px;
            color: var(--clr-sb-item);
        }
        
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 10px;
            border-radius: 8px;
            color: var(--clr-muted);
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            background: transparent;
            border: none;
            width: 100%;
        }
        
        .btn-logout:hover {
            background: #FEE2E2;
            color: var(--clr-danger);
        }

        /* ==========================================
           MAIN AREA 
        ========================================== */
        .main-area {
            flex: 1;
            min-width: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* ── TOPBAR ── */
        .topbar {
            height: 56px;
            min-height: 56px;
            background: white;
            border-bottom: 1px solid var(--clr-border);
            padding: 0 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            z-index: 5;
        }
        
        .tb-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .tb-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--clr-text);
        }
        
        .tb-date {
            font-size: 11px;
            color: var(--clr-muted);
            background: var(--clr-bg);
            padding: 3px 9px;
            border-radius: 99px;
            border: 1px solid var(--clr-border);
        }
        
        .tb-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .tb-icon-btn {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid var(--clr-border);
            color: var(--clr-muted);
            cursor: pointer;
            transition: all .15s;
            position: relative;
            font-size: 16px;
        }
        
        .tb-icon-btn:hover {
            background: var(--clr-bg);
            color: var(--clr-text);
        }
        
        .tb-badge {
            position: absolute;
            top: -3px;
            right: -3px;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: var(--clr-primary);
            color: white;
            font-size: 8px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        /* ── CONTENT SCROLL AREA ── */
        .content-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 22px 26px 48px;
        }

        /* ==========================================
           NOTIF PANEL OVERLAY
        ========================================== */
        .notif-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .18);
            z-index: 38;
            display: none;
        }
        
        .notif-overlay.open {
            display: block;
        }
        
        .notif-panel {
            position: fixed;
            top: 0;
            right: -360px;
            width: 340px;
            height: 100vh;
            background: white;
            border-left: 1px solid var(--clr-border);
            z-index: 39;
            display: flex;
            flex-direction: column;
            transition: right .25s cubic-bezier(.4, 0, .2, 1);
            box-shadow: -4px 0 24px rgba(0, 0, 0, .07);
        }
        
        .notif-panel.open {
            right: 0;
        }
        
        .notif-head {
            padding: 16px 16px 14px;
            border-bottom: 1px solid var(--clr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        
        .notif-title {
            font-size: 14px;
            font-weight: 700;
        }
        
        .notif-count {
            font-size: 11px;
            color: var(--clr-muted);
            margin-top: 2px;
        }
        
        .notif-list {
            flex: 1;
            overflow-y: auto;
            padding: 8px;
        }
        
        .notif-item {
            display: flex;
            gap: 10px;
            padding: 10px 10px;
            border-radius: 8px;
            margin-bottom: 2px;
            transition: background .1s;
            cursor: default;
        }
        
        .notif-item:hover {
            background: var(--clr-bg);
        }
        
        .notif-icon {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
            margin-top: 1px;
        }
        
        .notif-msg {
            font-size: 12px;
            color: var(--clr-text);
            line-height: 1.5;
        }
        
        .notif-time {
            font-size: 10px;
            color: var(--clr-muted);
            margin-top: 2px;
        }
        
        .notif-empty {
            text-align: center;
            padding: 48px 20px;
            color: var(--clr-muted);
            font-size: 12px;
        }

        /* ==========================================
           CARDS & STATISTICS
        ========================================== */
        .card {
            background: var(--clr-card);
            border: 1px solid var(--clr-border);
            border-radius: 12px;
        }
        
        .card-hd {
            padding: 13px 16px;
            border-bottom: 1px solid var(--clr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-hd-title {
            font-size: 13px;
            font-weight: 600;
        }

        .stat-card {
            background: var(--clr-card);
            border: 1px solid var(--clr-border);
            border-radius: 12px;
            padding: 16px;
        }
        
        .stat-lbl {
            font-size: 10px;
            font-weight: 700;
            color: var(--clr-muted);
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 8px;
        }
        
        .stat-val {
            font-size: 24px;
            font-weight: 700;
            line-height: 1;
        }
        
        .stat-sub {
            font-size: 11px;
            color: var(--clr-muted);
            margin-top: 5px;
        }

        /* ==========================================
           BUTTONS
        ========================================== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all .15s;
            border: none;
            font-family: 'Inter', sans-serif;
        }
        
        .btn-primary {
            background: var(--clr-primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--clr-primary-dark);
        }
        
        .btn-secondary {
            background: #F5F2EE;
            color: var(--clr-muted);
            border: 1px solid var(--clr-border);
        }
        
        .btn-secondary:hover {
            background: var(--clr-border);
            color: var(--clr-text);
        }
        
        .btn-ghost {
            background: transparent;
            color: var(--clr-muted);
            border: 1px solid var(--clr-border);
        }
        
        .btn-ghost:hover {
            background: var(--clr-bg);
        }
        
        .btn-sm {
            padding: 6px 10px;
            font-size: 11px;
        }
        
        .tbl-actions {
            display: flex;
            align-items: center;
            gap: 4px;
            justify-content: flex-end;
        }
        
        .btn-icon {
            padding: 6px;
            border-radius: 6px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-edit {
            background: var(--clr-info-bg);
            color: var(--clr-info);
        }
        
        .btn-edit:hover {
            background: #BAE6FD;
        }
        
        .btn-del {
            background: var(--clr-danger-bg);
            color: var(--clr-danger);
        }
        
        .btn-del:hover {
            background: #FECACA;
        }

        /* ==========================================
           FORMS & INPUTS
        ========================================== */
        .form-lbl {
            display: block;
            font-size: 10px;
            font-weight: 700;
            color: var(--clr-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 5px;
        }
        
        .form-input {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid var(--clr-border);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--clr-text);
            background: white;
            transition: all .15s;
            font-family: 'Inter', sans-serif;
        }
        
        .form-input:focus {
            border-color: var(--clr-primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(224, 123, 57, .1);
        }
        
        select.form-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%237A6F68' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 14px;
            padding-right: 30px;
            cursor: pointer;
        }
        
        .form-file {
            width: 100%;
            font-size: 11px;
            color: var(--clr-muted);
        }
        
        .form-file::file-selector-button {
            margin-right: 8px;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid var(--clr-border);
            background: white;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            color: var(--clr-text);
        }
        
        .form-file::file-selector-button:hover {
            background: var(--clr-bg);
        }
        
        .form-grp {
            margin-bottom: 14px;
        }

        /* ==========================================
           TABLES
        ========================================== */
        .dtable {
            width: 100%;
            border-collapse: collapse;
        }
        
        .dtable thead th {
            background: #FAFAF8;
            color: var(--clr-muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .6px;
            font-weight: 700;
            padding: 10px 14px;
            border-bottom: 1px solid var(--clr-border);
            text-align: left;
            white-space: nowrap;
        }
        
        .dtable tbody td {
            padding: 12px 14px;
            font-size: 13px;
            border-bottom: 1px solid #F7F4F0;
            vertical-align: middle;
        }
        
        .dtable tbody tr {
            background: white;
            transition: background .1s;
        }
        
        .dtable tbody tr:hover {
            background: var(--clr-primary-subtle);
        }
        
        .dtable tbody tr:last-child td {
            border-bottom: none;
        }
        
        .empty-row td {
            padding: 36px 20px;
            text-align: center;
            color: var(--clr-muted);
            font-size: 13px;
        }
        
        .clickable {
            cursor: pointer;
        }

        /* ==========================================
           BADGES (STATUS)
        ========================================== */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 3px 9px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }
        
        .b-antrian {
            background: #F5F2EE;
            color: #7A6F68;
        }
        
        .b-dicuci {
            background: var(--clr-info-bg);
            color: var(--clr-info);
        }
        
        .b-disetrika {
            background: #EDE9FE;
            color: #7C3AED;
        }
        
        .b-siap {
            background: #CCFBF1;
            color: #0F766E;
        }
        
        .b-selesai {
            background: var(--clr-success-bg);
            color: var(--clr-success);
        }

        /* ==========================================
           MODAL DIALOGS
        ========================================== */
        .modal-ov {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .28);
            backdrop-filter: blur(2px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
            padding: 16px;
        }
        
        .modal-ov.open {
            display: flex;
        }
        
        .modal-box {
            background: white;
            border-radius: 14px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .12);
            overflow: hidden;
            animation: mIn .2s ease-out;
        }
        
        @keyframes mIn {
            0% {
                opacity: 0;
                transform: translateY(10px) scale(.98);
            }
            100% {
                opacity: 1;
                transform: none;
            }
        }
        
        .modal-hd {
            padding: 13px 18px;
            border-bottom: 1px solid var(--clr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FAFAF8;
        }
        
        .modal-title {
            font-size: 13px;
            font-weight: 700;
        }
        
        .modal-close {
            background: none;
            border: none;
            color: var(--clr-muted);
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            font-size: 18px;
            line-height: 1;
        }
        
        .modal-close:hover {
            background: var(--clr-danger-bg);
            color: var(--clr-danger);
        }
        
        .modal-body {
            padding: 18px;
            overflow-y: auto;
        }
        
        .modal-ft {
            padding: 12px 18px;
            border-top: 1px solid var(--clr-border);
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            background: #FAFAF8;
        }

        /* ==========================================
           TOAST NOTIFICATION
        ========================================== */
        .toast-wrap {
            position: fixed;
            top: 14px;
            right: 14px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 8px;
            pointer-events: none;
        }
        
        .toast {
            background: white;
            border: 1px solid var(--clr-border);
            border-radius: 10px;
            padding: 11px 13px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            min-width: 240px;
            max-width: 320px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .08);
            pointer-events: all;
            animation: tIn .2s ease-out;
        }
        
        @keyframes tIn {
            0% {
                opacity: 0;
                transform: translateX(14px);
            }
            100% {
                opacity: 1;
                transform: none;
            }
        }
        
        .toast.hiding {
            animation: tOut .2s ease-in forwards;
        }
        
        @keyframes tOut {
            100% {
                opacity: 0;
                transform: translateX(14px);
            }
        }
        
        .toast-ico {
            width: 24px;
            height: 24px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }
        
        .toast-ico.success {
            background: var(--clr-success-bg);
            color: var(--clr-success);
        }
        
        .toast-ico.error {
            background: var(--clr-danger-bg);
            color: var(--clr-danger);
        }
        
        .toast-ico.info {
            background: var(--clr-info-bg);
            color: var(--clr-info);
        }
        
        .toast-ico.warning {
            background: var(--clr-warning-bg);
            color: var(--clr-warning);
        }
        
        .toast-ttl {
            font-size: 12px;
            font-weight: 700;
        }
        
        .toast-msg {
            font-size: 11px;
            color: var(--clr-muted);
            margin-top: 2px;
        }

        /* ==========================================
           RECEIPT THERMAL LAYOUT
        ========================================== */
        .receipt {
            font-family: 'Courier Prime', 'Courier New', monospace;
            background: white;
            padding: 24px;
            border: 1px dashed #C8BFB6;
            border-radius: 4px;
            width: 100%;
            color: #000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin: 0 auto;
        }
        
        .r-dash {
            border: none;
            border-top: 1px dashed #000;
            margin: 12px 0;
        }
        
        .r-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            line-height: 1.8;
            margin-bottom: 2px;
        }
        
        .r-ctr {
            text-align: center;
        }
        
        .r-bold {
            font-weight: 700;
        }
        
        .srch {
            position: relative;
        }
        
        .srch .ti-search {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--clr-muted);
            font-size: 14px;
            pointer-events: none;
        }
        
        .srch input {
            padding-left: 32px !important;
        }

        /* ==========================================
           PROGRESS TRACKER — REDESIGNED
        ========================================== */
        .prog-track-wrap {
            display: flex;
            align-items: flex-start;
            position: relative;
            padding: 4px 0 8px;
        }

        .prog-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .prog-step-row {
            display: flex;
            align-items: center;
            width: 100%;
            position: relative;
        }

        .prog-line {
            flex: 1;
            height: 3px;
            background: #EDE9E3;
            transition: background .4s ease;
        }

        .prog-line.done {
            background: var(--clr-primary);
        }

        .prog-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            flex-shrink: 0;
            border: 2.5px solid #EDE9E3;
            background: white;
            color: #C4B8B0;
            transition: all .3s ease;
            position: relative;
        }

        .prog-circle.done {
            background: var(--clr-primary);
            border-color: var(--clr-primary);
            color: white;
            box-shadow: 0 2px 8px rgba(224,123,57,.35);
        }

        .prog-circle.active {
            background: white;
            border-color: var(--clr-primary);
            border-width: 2.5px;
            color: var(--clr-primary);
            box-shadow: 0 0 0 4px rgba(224,123,57,.15);
        }

        .prog-circle.active::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px solid rgba(224,123,57,.3);
            animation: prog-pulse 1.6s ease-in-out infinite;
        }

        @keyframes prog-pulse {
            0%, 100% { transform: scale(1); opacity: .6; }
            50% { transform: scale(1.18); opacity: 0; }
        }

        .prog-icon {
            font-size: 14px;
        }

        .prog-lbl {
            font-size: 9.5px;
            font-weight: 600;
            margin-top: 7px;
            color: #C4B8B0;
            text-align: center;
            transition: color .3s;
            line-height: 1.3;
        }

        .prog-lbl.done { color: var(--clr-primary); }
        .prog-lbl.active { color: var(--clr-primary); }

        .prog-status-banner {
            margin-top: 14px;
            padding: 9px 13px;
            border-radius: 9px;
            background: var(--clr-primary-bg);
            border: 1px solid rgba(224,123,57,.2);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
            color: var(--clr-primary);
        }

        /* ==========================================
           PHOTO UPLOAD — ENHANCED PREVIEW
        ========================================== */
        .photo-upload-zone {
            border: 2px dashed var(--clr-border);
            border-radius: 10px;
            padding: 16px 14px;
            background: #FAFAF8;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            position: relative;
        }

        .photo-upload-zone:hover {
            border-color: var(--clr-primary);
            background: var(--clr-primary-bg);
        }

        .photo-upload-zone.has-file {
            border-color: var(--clr-primary);
            background: var(--clr-primary-bg);
            border-style: solid;
        }

        .photo-upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .photo-preview-thumb {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 6px;
            display: block;
            margin-bottom: 6px;
        }

        .photo-upload-hint {
            font-size: 11px;
            color: var(--clr-muted);
            pointer-events: none;
        }

        .photo-upload-hint .ti {
            font-size: 22px;
            display: block;
            margin-bottom: 4px;
            color: #C4B8B0;
        }

        .photo-file-name {
            font-size: 10px;
            font-weight: 600;
            color: var(--clr-primary);
            margin-top: 4px;
            word-break: break-all;
            pointer-events: none;
        }

        /* ==========================================
           GALLERY FOR PHOTOS
        ========================================== */
        .gal-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        
        .gal-item {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--clr-border);
            background: white;
            padding: 5px;
            transition: box-shadow .15s;
        }

        .gal-item:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
        }
        
        .gal-lbl {
            display: flex;
            align-items: center;
            gap: 5px;
            background: #F7F4F0;
            font-size: 9px;
            font-weight: 700;
            color: var(--clr-muted);
            padding: 4px 7px;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 5px;
            text-align: left;
            border-radius: 5px;
        }
        
        .gal-item img {
            width: 100%;
            height: 95px;
            object-fit: cover;
            display: block;
            border-radius: 5px;
            cursor: pointer;
            transition: opacity .15s, transform .15s;
        }
        
        .gal-item img:hover {
            opacity: .88;
            transform: scale(1.01);
        }
        
        .gal-empty {
            font-size: 11px;
            color: var(--clr-muted);
            text-align: center;
            padding: 24px 14px;
            background: #FAFAF8;
            border-radius: 10px;
            border: 1.5px dashed var(--clr-border);
        }

        /* ==========================================
           MISC UTILITIES
        ========================================== */
        .hl-box {
            background: var(--clr-primary-bg);
            border: 1px solid rgba(224, 123, 57, .18);
            border-radius: 8px;
            padding: 12px 13px;
        }
        
        .view-sec {
            animation: vFade .18s ease-out;
        }
        
        @keyframes vFade {
            0% {
                opacity: 0;
                transform: translateY(6px);
            }
            100% {
                opacity: 1;
                transform: none;
            }
        }
        
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* ==========================================
           PRINT MEDIA QUERIES
        ========================================== */
        @media print {
            body * {
                visibility: hidden !important;
            }
            
            #printableReceipt, #printableReceipt * {
                visibility: visible !important;
            }
            
            #printableReceipt {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 80mm !important;
                margin: 0 !important;
                padding: 10px !important;
                border: none !important;
                box-shadow: none !important;
                background: white !important;
                color: black !important;
                font-family: 'Courier Prime', 'Courier New', monospace !important;
            }
            
            .no-print {
                display: none !important;
            }
            
            .modal-ov {
                background: transparent !important;
            }
        }
    </style>
</head>
<body>

<div class="toast-wrap" id="toastWrap"></div>

<div class="notif-overlay" id="notifOverlay" onclick="closeNotif()"></div>

<div class="notif-panel" id="notifPanel">
    <div class="notif-head">
        <div>
            <div class="notif-title">Aktivitas</div>
            <div class="notif-count" id="notifCount">0 aktivitas</div>
        </div>
        <div style="display:flex;gap:6px;">
            <button onclick="clearActivities()" class="btn btn-secondary btn-sm btn-icon" title="Hapus semua">
                <i class="ti ti-trash" style="font-size:13px;"></i>
            </button>
            <button onclick="closeNotif()" class="btn btn-ghost btn-sm btn-icon">
                <i class="ti ti-x" style="font-size:13px;"></i>
            </button>
        </div>
    </div>
    
    <div class="notif-list" id="notifList">
        <div class="notif-empty">
            <i class="ti ti-bell-off" style="font-size:28px;display:block;margin-bottom:8px;opacity:.35;"></i>
            Belum ada aktivitas
        </div>
    </div>
</div>

<div class="app-root">

    <aside class="sidebar">
        <div class="sb-logo">
            <div class="sb-logo-icon">LA</div>
            <div>
                <div class="sb-logo-name">Laundrea</div>
                <div class="sb-logo-sub">Admin Panel</div>
            </div>
        </div>
        
        <nav class="sb-nav">
            <div class="sb-section">Menu</div>
            
            <button class="nav-item active" id="nav-beranda" onclick="switchTab('beranda')">
                <i class="ti ti-layout-dashboard"></i>
                <span>Dashboard</span>
            </button>
            
            <button class="nav-item" id="nav-transaksi" onclick="switchTab('transaksi')">
                <i class="ti ti-file-invoice"></i>
                <span>Transaksi POS</span>
                <span class="nav-dot" id="transaksiDot" style="display:none;"></span>
            </button>
            
            <button class="nav-item" id="nav-layanan" onclick="switchTab('layanan')">
                <i class="ti ti-stack-2"></i>
                <span>Katalog Layanan</span>
            </button>
            
            <button class="nav-item" id="nav-pelanggan" onclick="switchTab('pelanggan')">
                <i class="ti ti-users"></i>
                <span>Data Pelanggan</span>
            </button>
        </nav>
        
        <div class="sb-foot">
            <div class="sb-user">
                <div class="sb-avatar" id="sbAvatar">AD</div>
                <div>
                    <div class="sb-uname" id="sbAdminName">Admin</div>
                    <div class="sb-urole">Administrator</div>
                </div>
            </div>
            <button class="btn-logout" onclick="logout()">
                <i class="ti ti-logout" style="font-size:14px;"></i> Keluar
            </button>
        </div>
    </aside>

    <div class="main-area">

        <header class="topbar">
            <div class="tb-left">
                <span class="tb-title" id="topbarTitle">Dashboard</span>
                <span class="tb-date" id="currentDate"></span>
            </div>
            
            <div class="tb-right">
                <button class="tb-icon-btn" onclick="openNotif()" title="Aktivitas">
                    <i class="ti ti-bell" style="font-size:16px;"></i>
                    <span class="tb-badge" id="notifBadge" style="display:none;">0</span>
                </button>
                <button onclick="switchTab('transaksi');setTimeout(openTrxModal,100);" class="btn btn-primary btn-sm">
                    <i class="ti ti-plus" style="font-size:13px;"></i> Transaksi Baru
                </button>
            </div>
        </header>

        <div class="content-scroll">

            <div id="view-beranda" class="view-sec">

                <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;">
                    <div>
                        <h1 style="font-size:19px;font-weight:700;">Selamat datang</h1>
                        <p style="font-size:12px;color:var(--clr-muted);margin-top:4px;">Ringkasan aktivitas laundry Anda hari ini.</p>
                    </div>
                    <button onclick="doRefresh()" class="btn btn-secondary btn-sm">
                        <i class="ti ti-refresh" style="font-size:13px;"></i> Refresh
                    </button>
                </div>

                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:16px;">
                    
                    <div class="stat-card" style="border-left:3px solid #60A5FA;">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                            <div class="stat-lbl">Total Pelanggan</div>
                            <div style="width:34px;height:34px;border-radius:9px;background:var(--clr-info-bg);display:flex;align-items:center;justify-content:center;">
                                <i class="ti ti-users" style="color:var(--clr-info);font-size:17px;"></i>
                            </div>
                        </div>
                        <div class="stat-val" id="stat-customers">0</div>
                        <div class="stat-sub">Terdaftar</div>
                    </div>
                    
                    <div class="stat-card" style="border-left:3px solid #FBBF24;">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                            <div class="stat-lbl">Pesanan Aktif</div>
                            <div style="width:34px;height:34px;border-radius:9px;background:var(--clr-warning-bg);display:flex;align-items:center;justify-content:center;">
                                <i class="ti ti-loader-2" style="color:var(--clr-warning);font-size:17px;"></i>
                            </div>
                        </div>
                        <div class="stat-val" id="stat-active">0</div>
                        <div class="stat-sub">Belum diambil</div>
                    </div>
                    
                    <div class="stat-card" style="border-left:3px solid #A3A3A3;">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                            <div class="stat-lbl">Total Transaksi</div>
                            <div style="width:34px;height:34px;border-radius:9px;background:#F5F2EE;display:flex;align-items:center;justify-content:center;">
                                <i class="ti ti-file-invoice" style="color:var(--clr-muted);font-size:17px;"></i>
                            </div>
                        </div>
                        <div class="stat-val" id="stat-transactions">0</div>
                        <div class="stat-sub">Nota tercatat</div>
                    </div>
                    
                    <div class="stat-card" style="background:var(--clr-primary);border-color:var(--clr-primary);border-left:3px solid rgba(255,255,255,.4);">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                            <div class="stat-lbl" style="color:rgba(255,255,255,.7);">Total Omzet</div>
                            <div style="width:34px;height:34px;border-radius:9px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;">
                                <i class="ti ti-currency-dollar" style="color:white;font-size:17px;"></i>
                            </div>
                        </div>
                        <div class="stat-val" style="color:white;font-size:18px;" id="stat-revenue">Rp 0</div>
                        <div class="stat-sub" style="color:rgba(255,255,255,.65);">Keseluruhan</div>
                    </div>

                </div>

                <div style="display:grid;grid-template-columns:2fr 1fr;gap:12px;margin-bottom:16px;">
                    
                    <div class="card">
                        <div class="card-hd">
                            <span class="card-hd-title">Status Pesanan</span>
                            <div style="display:flex;gap:5px;">
                                <button onclick="renderChart(trxData,'bar')" class="btn btn-ghost btn-sm btn-icon">
                                    <i class="ti ti-chart-bar" style="font-size:13px;"></i>
                                </button>
                                <button onclick="renderChart(trxData,'doughnut')" class="btn btn-ghost btn-sm btn-icon">
                                    <i class="ti ti-chart-donut" style="font-size:13px;"></i>
                                </button>
                            </div>
                        </div>
                        <div style="padding:14px;height:200px;position:relative;">
                            <canvas id="mainChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-hd">
                            <span class="card-hd-title">Layanan Favorit</span>
                            <i class="ti ti-award" style="font-size:14px;color:var(--clr-muted);"></i>
                        </div>
                        <div style="padding:14px;">
                            <div id="popularList" style="display:flex;flex-direction:column;gap:10px;"></div>
                        </div>
                    </div>

                </div>

                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:16px;">
                    
                    <div class="stat-card" style="border-left:3px solid #4ADE80;">
                        <div class="stat-lbl">Pendapatan Lunas</div>
                        <div class="stat-val" id="rep-paid" style="font-size:18px;color:var(--clr-success);">Rp 0</div>
                        <div class="stat-sub">Status paid / lunas</div>
                    </div>
                    
                    <div class="stat-card" style="border-left:3px solid #34D399;">
                        <div class="stat-lbl">Transaksi Selesai</div>
                        <div class="stat-val" id="rep-done" style="font-size:18px;">0</div>
                        <div class="stat-sub">Status diambil</div>
                    </div>
                    
                    <div class="stat-card" style="border-left:3px solid #FBBF24;">
                        <div class="stat-lbl">Masih Berlangsung</div>
                        <div class="stat-val" id="rep-pending" style="font-size:18px;">0</div>
                        <div class="stat-sub">Belum selesai</div>
                    </div>

                </div>

                <div class="card">
                    <div class="card-hd">
                        <span class="card-hd-title">Transaksi Terbaru</span>
                        <button onclick="switchTab('transaksi')" style="font-size:11px;font-weight:600;color:var(--clr-primary);background:none;border:none;cursor:pointer;">
                            Lihat Semua →
                        </button>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="dtable">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Invoice</th>
                                    <th>Layanan</th>
                                    <th>Total</th>
                                    <th style="text-align:center;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="recentTBody">
                                <tr class="empty-row">
                                    <td colspan="5">Memuat...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div id="view-transaksi" class="view-sec" style="display:none;">
                
                <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:16px;flex-wrap:wrap;gap:10px;">
                    <div>
                        <h2 style="font-size:18px;font-weight:700;">Transaksi POS</h2>
                        <p style="font-size:12px;color:var(--clr-muted);margin-top:4px;">Klik baris pesanan untuk detail & update status.</p>
                    </div>
                    
                    <div style="display:flex;flex-wrap:wrap;gap:7px;align-items:center;">
                        <button onclick="exportCSV()" class="btn btn-secondary btn-sm">
                            <i class="ti ti-download" style="font-size:13px;"></i> Ekspor CSV
                        </button>
                        
                        <div class="srch">
                            <i class="ti ti-search"></i>
                            <input type="text" id="srchTrx" placeholder="Cari nama/invoice..." class="form-input" style="padding:7px 12px 7px 32px;width:180px;font-size:12px;" oninput="filterTrxLocal()">
                        </div>
                        
                        <input type="date" id="filterDate" onchange="fetchTrx()" class="form-input" style="width:130px;font-size:12px;padding:7px 12px;">
                        
                        <select id="filterStatus" onchange="fetchTrx()" class="form-input" style="width:145px;font-size:12px;padding:7px 28px 7px 12px;">
                            <option value="">Semua Status</option>
                            <option value="antrian">Antrian</option>
                            <option value="dicuci">Dicuci</option>
                            <option value="disetrika">Disetrika</option>
                            <option value="siap diambil">Siap Diambil</option>
                            <option value="diambil">Selesai</option>
                        </select>
                    </div>
                </div>
                
                <div class="card" style="overflow:hidden;">
                    <div style="overflow-x:auto;">
                        <table class="dtable">
                            <thead>
                                <tr>
                                    <th>Waktu & Invoice</th>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Tagihan</th>
                                    <th>Bayar</th>
                                    <th style="text-align:center;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="trxTBody">
                                <tr class="empty-row">
                                    <td colspan="6">Memuat...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <div id="view-layanan" class="view-sec" style="display:none;">
                
                <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:16px;">
                    <div>
                        <h2 style="font-size:18px;font-weight:700;">Katalog Layanan</h2>
                        <p style="font-size:12px;color:var(--clr-muted);margin-top:4px;">Kelola harga dan jenis layanan.</p>
                    </div>
                    <button onclick="openSrvModal()" class="btn btn-primary btn-sm">
                        <i class="ti ti-plus" style="font-size:13px;"></i> Tambah Layanan
                    </button>
                </div>
                
                <div class="card" style="overflow:hidden;">
                    <div style="overflow-x:auto;">
                        <table class="dtable">
                            <thead>
                                <tr>
                                    <th>Nama Layanan</th>
                                    <th>Harga Pokok</th>
                                    <th>Tipe Satuan</th>
                                    <th style="text-align:right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="srvTBody">
                                <tr class="empty-row">
                                    <td colspan="4">Memuat...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <div id="view-pelanggan" class="view-sec" style="display:none;">
                
                <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:16px;flex-wrap:wrap;gap:10px;">
                    <div>
                        <h2 style="font-size:18px;font-weight:700;">Data Pelanggan</h2>
                        <p style="font-size:12px;color:var(--clr-muted);margin-top:4px;">Database pelanggan terdaftar.</p>
                    </div>
                    
                    <div style="display:flex;gap:7px;align-items:center;flex-wrap:wrap;">
                        <div class="srch">
                            <i class="ti ti-search"></i>
                            <input type="text" id="srchCust" placeholder="Cari nama/WA..." class="form-input" style="padding:7px 12px 7px 32px;width:180px;font-size:12px;" onkeyup="if(event.key==='Enter')fetchCusts()">
                        </div>
                        <button onclick="fetchCusts()" class="btn btn-secondary btn-sm">
                            <i class="ti ti-search" style="font-size:13px;"></i>
                        </button>
                        <button onclick="openCustModal()" class="btn btn-primary btn-sm">
                            <i class="ti ti-user-plus" style="font-size:13px;"></i> Registrasi
                        </button>
                    </div>
                </div>
                
                <div class="card" style="overflow:hidden;">
                    <div style="overflow-x:auto;">
                        <table class="dtable">
                            <thead>
                                <tr>
                                    <th>Info Pelanggan</th>
                                    <th>WhatsApp</th>
                                    <th>Alamat Domisili</th>
                                    <th>Trx Selesai</th>
                                    <th style="text-align:right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="custTBody">
                                <tr class="empty-row">
                                    <td colspan="5">Memuat...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

        </div></div></div><div class="modal-ov" id="srvModal">
    <div class="modal-box" style="max-width:380px;">
        <div class="modal-hd">
            <span class="modal-title" id="srvModalTitle">Tambah Layanan</span>
            <button class="modal-close" onclick="closeModal('srvModal')">
                <i class="ti ti-x"></i>
            </button>
        </div>
        
        <form id="srvForm">
            <div class="modal-body">
                <input type="hidden" id="srv_id">
                
                <div class="form-grp">
                    <label class="form-lbl">Nama Layanan</label>
                    <input type="text" id="srv_name" class="form-input" placeholder="Cuci Kiloan Premium" required>
                </div>
                
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                    <div class="form-grp">
                        <label class="form-lbl">Tipe Satuan</label>
                        <select id="srv_type" class="form-input" required>
                            <option value="kiloan">Per Kg</option>
                            <option value="satuan">Per Pcs</option>
                        </select>
                    </div>
                    
                    <div class="form-grp">
                        <label class="form-lbl">Harga (Rp)</label>
                        <input type="number" id="srv_price" class="form-input" placeholder="15000" required>
                    </div>
                </div>
            </div>
            
            <div class="modal-ft">
                <button type="button" onclick="closeModal('srvModal')" class="btn btn-secondary btn-sm">Batal</button>
                <button type="submit" id="btnSaveSrv" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-ov" id="custModal">
    <div class="modal-box" style="max-width:400px;max-height:90vh;overflow-y:auto;">
        <div class="modal-hd">
            <span class="modal-title" id="custModalTitle">Registrasi Pelanggan</span>
            <button class="modal-close" onclick="closeModal('custModal')">
                <i class="ti ti-x"></i>
            </button>
        </div>
        
        <form id="custForm">
            <div class="modal-body">
                <input type="hidden" id="cust_id">
                
                <div class="form-grp">
                    <label class="form-lbl">Nama Lengkap</label>
                    <input type="text" id="cust_name" class="form-input" required>
                </div>
                
                <div id="authFields" class="hl-box" style="margin-bottom:14px;">
                    <p style="font-size:10px;font-weight:700;color:var(--clr-primary);text-transform:uppercase;letter-spacing:.5px;margin:0 0 10px;">
                        Akses Aplikasi Mobile
                    </p>
                    
                    <div class="form-grp" style="margin-bottom:10px;">
                        <label class="form-lbl">Email Login</label>
                        <input type="email" id="cust_email" class="form-input" placeholder="email@pelanggan.com">
                    </div>
                    
                    <div class="form-grp" style="margin-bottom:0;">
                        <label class="form-lbl">Password</label>
                        <input type="password" id="cust_pass" class="form-input" placeholder="Min. 8 karakter">
                    </div>
                </div>
                
                <div class="form-grp">
                    <label class="form-lbl">No. WhatsApp</label>
                    <input type="number" id="cust_phone" class="form-input" placeholder="08xxxxxxxxxx" required>
                </div>
                
                <div class="form-grp" style="margin-bottom:0;">
                    <label class="form-lbl">Alamat Domisili</label>
                    <textarea id="cust_addr" class="form-input" rows="2" required style="resize:vertical;"></textarea>
                </div>
            </div>
            
            <div class="modal-ft">
                <button type="button" onclick="closeModal('custModal')" class="btn btn-secondary btn-sm">Batal</button>
                <button type="submit" id="btnSaveCust" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-ov" id="trxModal">
    <div class="modal-box" style="max-width:460px;max-height:90vh;overflow-y:auto;">
        <div class="modal-hd">
            <span class="modal-title">
                <i class="ti ti-file-plus" style="font-size:14px;color:var(--clr-primary);margin-right:5px;"></i> Form Nota Baru
            </span>
            <button class="modal-close" onclick="closeModal('trxModal')">
                <i class="ti ti-x"></i>
            </button>
        </div>
        
        <form id="trxForm">
            <div class="modal-body">
                <div class="form-grp">
                    <label class="form-lbl">Pelanggan</label>
                    <select id="trx_cust" class="form-input" required></select>
                </div>
                
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                    <div class="form-grp">
                        <label class="form-lbl">Layanan</label>
                        <select id="trx_srv" class="form-input" required onchange="updateQtyLabel()"></select>
                    </div>
                    
                    <div class="form-grp">
                        <label id="lblQty" class="form-lbl">Kuantitas</label>
                        <input type="number" step="any" id="trx_qty" class="form-input" placeholder="Cth: 2.5" required>
                    </div>
                </div>
                
                <div class="form-grp">
                    <label class="form-lbl">Metode Pembayaran</label>
                    <select id="trx_pay" class="form-input" required onchange="toggleProof()">
                        <option value="cash">Tunai (Bayar di Kasir)</option>
                        <option value="transfer">Transfer Bank / QRIS</option>
                    </select>
                </div>
                
                <div id="proofBox" style="display:none;" class="form-grp">
                    <div class="hl-box">
                        <label class="form-lbl" style="margin-bottom:7px;">Upload Bukti Transfer</label>
                        <input type="file" id="trx_proof" accept="image/*" class="form-file">
                    </div>
                </div>
                
                <div class="hl-box">
                    <label class="form-lbl" style="margin-bottom:7px;">
                        <i class="ti ti-camera" style="font-size:11px;"></i> Foto Pakaian Masuk (Opsional)
                    </label>
                    <input type="file" id="trx_photo" accept="image/*" class="form-file">
                </div>
            </div>
            
            <div class="modal-ft">
                <button type="button" onclick="closeModal('trxModal')" class="btn btn-secondary btn-sm">Batal</button>
                <button type="submit" id="btnSaveTrx" class="btn btn-primary btn-sm">
                    <i class="ti ti-device-floppy" style="font-size:12px;"></i> Simpan Order
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal-ov" id="detailModal">
    <div class="modal-box" style="max-width:860px;max-height:92vh;overflow-y:auto;background:#FAFAF8;">
        
        <div class="modal-hd no-print" style="background:white;">
            <div style="display:flex;align-items:center;gap:9px;">
                <div style="width:30px;height:30px;background:var(--clr-primary-bg);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <i class="ti ti-washing-machine" style="font-size:15px;color:var(--clr-primary);"></i>
                </div>
                <div>
                    <span class="modal-title">Detail Transaksi</span>
                    <div style="font-size:10px;color:var(--clr-muted);margin-top:1px;">Kelola & pantau progress cucian</div>
                </div>
                <span id="detBadge" style="margin-left:4px;"></span>
            </div>
            <button class="modal-close" onclick="closeModal('detailModal')">
                <i class="ti ti-x"></i>
            </button>
        </div>

        <div style="display:flex;flex-wrap:wrap;flex-direction:row;">
            
            <!-- Kolom Kiri: Progress + Form Update -->
            <div class="no-print" style="flex:1;min-width:300px;padding:18px;border-right:1px solid var(--clr-border);display:flex;flex-direction:column;gap:14px;">
                
                <!-- Progress Tracker Card -->
                <div style="background:white;padding:16px;border-radius:13px;border:1px solid var(--clr-border);">
                    <div style="display:flex;align-items:center;gap:7px;margin-bottom:14px;">
                        <i class="ti ti-timeline" style="font-size:13px;color:var(--clr-primary);"></i>
                        <span style="font-size:11px;font-weight:700;color:var(--clr-text);text-transform:uppercase;letter-spacing:.5px;">Progress Cucian</span>
                    </div>
                    <div id="progTracker"></div>
                </div>

                <!-- Update Status Card -->
                <div style="background:white;padding:16px;border-radius:13px;border:1px solid var(--clr-border);">
                    <div style="display:flex;align-items:center;gap:7px;margin-bottom:14px;">
                        <i class="ti ti-edit" style="font-size:13px;color:var(--clr-primary);"></i>
                        <span style="font-size:11px;font-weight:700;color:var(--clr-text);text-transform:uppercase;letter-spacing:.5px;">Update Progress</span>
                    </div>
                    
                    <form id="statusForm">
                        <input type="hidden" id="det_trx_id">
                        
                        <div class="form-grp">
                            <label class="form-lbl">Status Baru</label>
                            <select id="det_status" class="form-input" style="font-weight:600;">
                                <option value="antrian">1. Antrian Masuk</option>
                                <option value="dicuci">2. Sedang Dicuci</option>
                                <option value="disetrika">3. Sedang Disetrika</option>
                                <option value="siap diambil">4. Siap Diambil</option>
                                <option value="diambil">5. Selesai (Diambil)</option>
                            </select>
                        </div>
                        
                        <!-- Upload Foto — Redesigned dengan Preview -->
                        <div class="form-grp" style="margin-bottom:14px;">
                            <label class="form-lbl">
                                <i class="ti ti-camera" style="font-size:10px;"></i> Lampirkan Foto Hasil (Opsional)
                            </label>
                            <div class="photo-upload-zone" id="photoUploadZone" onclick="document.getElementById('det_photo').click()">
                                <input type="file" id="det_photo" accept="image/*" style="position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;" onchange="handlePhotoPreview(this)">
                                <div id="photoUploadContent">
                                    <div class="photo-upload-hint">
                                        <i class="ti ti-photo-up"></i>
                                        <span>Klik untuk pilih foto</span><br>
                                        <span style="font-size:10px;opacity:.7;">JPG, PNG — Maks 5MB</span>
                                    </div>
                                </div>
                            </div>
                            <div id="photoResetRow" style="display:none;margin-top:6px;text-align:right;">
                                <button type="button" onclick="resetPhotoUpload()" style="font-size:10px;font-weight:600;color:var(--clr-danger);background:none;border:none;cursor:pointer;padding:2px 4px;">
                                    <i class="ti ti-x" style="font-size:10px;"></i> Hapus Foto
                                </button>
                            </div>
                        </div>
                        
                        <button type="submit" id="btnUpdateStatus" class="btn btn-primary" style="width:100%;justify-content:center;padding:10px;">
                            <i class="ti ti-check" style="font-size:13px;"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Galeri Foto -->
                <div style="background:white;padding:16px;border-radius:13px;border:1px solid var(--clr-border);">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                        <div style="display:flex;align-items:center;gap:7px;">
                            <i class="ti ti-photo-album" style="font-size:13px;color:var(--clr-primary);"></i>
                            <span style="font-size:11px;font-weight:700;color:var(--clr-text);text-transform:uppercase;letter-spacing:.5px;">Galeri Foto & Bukti</span>
                        </div>
                    </div>
                    <div id="galTracking"></div>
                </div>
            </div>

            <!-- Kolom Kanan: Struk Thermal -->
            <div style="width:320px;min-width:320px;padding:18px;background:#F5F2EE;display:flex;flex-direction:column;gap:12px;align-items:center;">
                <button onclick="window.print()" class="btn btn-primary no-print" style="width:100%;justify-content:center;padding:10px;font-size:13px;box-shadow:0 4px 12px rgba(224,123,57,.25);">
                    <i class="ti ti-printer" style="font-size:15px;"></i> Cetak Struk
                </button>
                
                <div id="printableReceipt" class="receipt">
                    <div class="r-ctr" style="margin-bottom:14px;">
                        <div style="font-size:22px;font-weight:700;letter-spacing:4px;margin-bottom:4px;">LAUNDREA</div>
                        <div style="font-size:11px;">Sistem Cerdas Laundry</div>
                        <div style="font-size:11px;margin-top:2px;" id="r_date">-</div>
                    </div>
                    
                    <hr class="r-dash">
                    
                    <div style="margin:10px 0;line-height:1.6;">
                        <div class="r-row">
                            <span>No. Nota:</span>
                            <span class="r-bold" id="r_inv">-</span>
                        </div>
                        <div class="r-row">
                            <span>Pelanggan:</span>
                            <span class="r-bold" id="r_cust">-</span>
                        </div>
                        <div class="r-row">
                            <span>Kasir:</span>
                            <span>Admin</span>
                        </div>
                    </div>
                    
                    <hr class="r-dash">
                    
                    <div style="margin:12px 0;">
                        <div style="font-size:13px;font-weight:700;margin-bottom:6px;text-transform:uppercase;" id="r_srv">-</div>
                        <div class="r-row">
                            <span id="r_qty">-</span>
                            <span id="r_price">Rp 0</span>
                        </div>
                    </div>
                    
                    <hr class="r-dash">
                    
                    <div style="margin:12px 0;line-height:1.6;">
                        <div class="r-row r-bold" style="font-size:15px;margin-bottom:6px;">
                            <span>TOTAL</span>
                            <span id="r_total">Rp 0</span>
                        </div>
                        <div class="r-row">
                            <span>Metode Bayar:</span>
                            <span style="text-transform:uppercase;" id="r_pay">-</span>
                        </div>
                        <div class="r-row">
                            <span>Status Lunas:</span>
                            <span class="r-bold" style="text-transform:uppercase;" id="r_paystatus">-</span>
                        </div>
                    </div>
                    
                    <hr class="r-dash">
                    
                    <div class="r-ctr" style="font-size:11px;line-height:1.6;margin-top:14px;">
                        <div>Terima kasih telah mempercayakan</div>
                        <div>cucian Anda kepada Laundrea.</div>
                        <div style="margin-top:8px;font-style:italic;">Simpan nota sebagai bukti pengambilan.</div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
'use strict';

/* ==========================================
   TANGGAL HARI INI
========================================== */
document.getElementById('currentDate').textContent = new Date().toLocaleDateString('id-ID', { 
    weekday: 'long', 
    day: 'numeric', 
    month: 'long', 
    year: 'numeric' 
});

/* ==========================================
   AUTHENTICATION CHECK
========================================== */
const token = localStorage.getItem('token');

if (!token) {
    window.location.href = '/login';
}

const H = { 
    'Authorization': `Bearer ${token}`, 
    'Accept': 'application/json', 
    'Content-Type': 'application/json' 
};

const HF = { 
    'Authorization': `Bearer ${token}`, 
    'Accept': 'application/json' 
};

try {
    const u = JSON.parse(localStorage.getItem('user') || '{}');
    if (u?.name) {
        document.getElementById('sbAdminName').textContent = u.name;
        document.getElementById('sbAvatar').textContent = u.name.substring(0, 2).toUpperCase();
    }
} catch (error) {
    console.error('Error parsing user data:', error);
}

/* ==========================================
   STATE VARIABLES (DATA PENYIMPANAN)
========================================== */
let custData = [];
let srvData = [];
let trxData = [];
let chartInst = null;
let chartType = 'bar';

/* ==========================================
   ACTIVITY LOG / NOTIFICATIONS
========================================== */
let acts = [];
try { 
    acts = JSON.parse(localStorage.getItem('la_acts') || '[]'); 
} catch(error) {
    console.error('Error parsing activity log:', error);
}

const ACT_ICONS = {
    order:    { icon: 'ti-file-plus',    bg: '#FEF0E4', clr: '#E07B39' },
    update:   { icon: 'ti-edit',         bg: '#EDE9FE', clr: '#7C3AED' },
    customer: { icon: 'ti-user-plus',    bg: '#E0F2FE', clr: '#0284C7' },
    service:  { icon: 'ti-stack-2',      bg: '#FEF3C7', clr: '#D97706' },
    delete:   { icon: 'ti-trash',        bg: '#FEE2E2', clr: '#DC2626' },
    success:  { icon: 'ti-circle-check', bg: '#DCFCE7', clr: '#16A34A' },
    info:     { icon: 'ti-info-circle',  bg: '#E0F2FE', clr: '#0284C7' },
};

function saveActs() { 
    localStorage.setItem('la_acts', JSON.stringify(acts.slice(0, 60))); 
}

function addActivity(type, msg) {
    const now = new Date();
    const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ', ' + now.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
    
    acts.unshift({ type: type, msg: msg, time: timeStr });
    saveActs();
    renderNotifPanel();
    updateBadge();
}

function renderNotifPanel() {
    const list = document.getElementById('notifList');
    const cnt  = document.getElementById('notifCount');
    
    cnt.textContent = acts.length + ' aktivitas';
    
    if (acts.length === 0) {
        list.innerHTML = `
        <div class="notif-empty">
            <i class="ti ti-bell-off" style="font-size:28px;display:block;margin-bottom:8px;opacity:.35;"></i>
            Belum ada aktivitas
        </div>`;
        return;
    }
    
    let htmlContent = '';
    
    acts.forEach(function(a) {
        const ic = ACT_ICONS[a.type] || ACT_ICONS.info;
        htmlContent += `
        <div class="notif-item">
            <div class="notif-icon" style="background:${ic.bg};color:${ic.clr};">
                <i class="ti ${ic.icon}"></i>
            </div>
            <div style="flex:1;">
                <div class="notif-msg">${a.msg}</div>
                <div class="notif-time">
                    <i class="ti ti-clock" style="font-size:10px;vertical-align:-1px;"></i> ${a.time}
                </div>
            </div>
        </div>`;
    });
    
    list.innerHTML = htmlContent;
}

function updateBadge() {
    const b = document.getElementById('notifBadge');
    
    if (acts.length > 0) { 
        b.style.display = 'flex'; 
        if (acts.length > 9) {
            b.textContent = '9+';
        } else {
            b.textContent = acts.length;
        }
    } else {
        b.style.display = 'none';
    }
}

function openNotif() { 
    document.getElementById('notifPanel').classList.add('open'); 
    document.getElementById('notifOverlay').classList.add('open'); 
}

function closeNotif() { 
    document.getElementById('notifPanel').classList.remove('open'); 
    document.getElementById('notifOverlay').classList.remove('open'); 
}

function clearActivities() { 
    acts = []; 
    saveActs(); 
    renderNotifPanel(); 
    updateBadge(); 
    toast('info', 'Aktivitas dibersihkan'); 
}

/* ==========================================
   TOAST NOTIFICATION COMPONENT
========================================== */
const TICONS = { 
    success: 'ti-circle-check', 
    error: 'ti-circle-x', 
    info: 'ti-info-circle', 
    warning: 'ti-alert-triangle' 
};

function toast(type, title, msg = '') {
    const el = document.createElement('div');
    el.className = 'toast';
    
    let htmlContent = `
        <div class="toast-ico ${type}">
            <i class="ti ${TICONS[type] || 'ti-bell'}"></i>
        </div>
        <div style="flex:1;">
            <div class="toast-ttl">${title}</div>`;
            
    if (msg) {
        htmlContent += `<div class="toast-msg">${msg}</div>`;
    }
    
    htmlContent += `
        </div>
        <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:var(--clr-muted);font-size:15px;padding:2px;line-height:1;">
            <i class="ti ti-x"></i>
        </button>`;
        
    el.innerHTML = htmlContent;
    document.getElementById('toastWrap').appendChild(el);
    
    setTimeout(function() { 
        el.classList.add('hiding'); 
        setTimeout(function() { 
            el.remove(); 
        }, 200); 
    }, 3500);
}

/* ==========================================
   TABS NAVIGATION LOGIC
========================================== */
const TAB_TITLES = { 
    beranda: 'Dashboard', 
    transaksi: 'Transaksi POS', 
    layanan: 'Katalog Layanan', 
    pelanggan: 'Data Pelanggan' 
};

function switchTab(tab) {
    const allTabs = ['beranda', 'transaksi', 'layanan', 'pelanggan'];
    
    allTabs.forEach(function(t) {
        const v = document.getElementById('view-' + t);
        const n = document.getElementById('nav-' + t);
        
        if (v) {
            v.style.display = 'none';
        }
        
        if (n) {
            n.classList.remove('active');
        }
    });
    
    const viewElement = document.getElementById('view-' + tab);
    const navElement = document.getElementById('nav-' + tab);
    
    if (viewElement) { 
        viewElement.style.display = 'block'; 
        viewElement.classList.remove('view-sec'); 
        
        // Memicu reflow browser agar animasi jalan
        void viewElement.offsetWidth; 
        
        viewElement.classList.add('view-sec'); 
    }
    
    if (navElement) {
        navElement.classList.add('active');
    }
    
    document.getElementById('topbarTitle').textContent = TAB_TITLES[tab] || tab;
}

/* ==========================================
   MODAL TOGGLERS
========================================== */
function openModal(id) { 
    document.getElementById(id).classList.add('open'); 
}

function closeModal(id) { 
    document.getElementById(id).classList.remove('open'); 
}

// Event listener agar modal tertutup saat klik overlay gelap di luarnya
document.querySelectorAll('.modal-ov').forEach(function(m) { 
    m.addEventListener('click', function(e) { 
        if (e.target === m) {
            m.classList.remove('open'); 
        }
    }); 
});

/* ==========================================
   FORMATTING HELPERS
========================================== */
function badge(statusString) {
    const mapBadge = {
        'antrian':      '<span class="badge b-antrian">Antrian</span>',
        'dicuci':       '<span class="badge b-dicuci">Dicuci</span>',
        'disetrika':    '<span class="badge b-disetrika">Setrika</span>',
        'siap diambil': '<span class="badge b-siap">Siap Ambil</span>',
        'diambil':      '<span class="badge b-selesai">Selesai</span>',
        'selesai':      '<span class="badge b-selesai">Selesai</span>',
    };
    
    if (mapBadge[statusString]) {
        return mapBadge[statusString];
    } else {
        return mapBadge['antrian'];
    }
}

function rp(value) { 
    let parseVal = parseFloat(value || 0);
    return 'Rp ' + parseVal.toLocaleString('id-ID'); 
}

function fDate(dateString) { 
    const dateObj = new Date(dateString);
    return dateObj.toLocaleDateString('id-ID', {
        day: '2-digit', 
        month: 'short', 
        year: '2-digit'
    }); 
}

function fDT(dateString) { 
    const dateObj = new Date(dateString); 
    const dStr = dateObj.toLocaleDateString('id-ID', {
        day: '2-digit', 
        month: 'short'
    });
    const tStr = dateObj.toLocaleTimeString('id-ID', {
        hour: '2-digit', 
        minute: '2-digit'
    });
    
    return dStr + ' ' + tStr; 
}

function cName(customerObj) { 
    if (!customerObj) {
        return 'Tanpa Nama'; 
    }
    
    if (customerObj.name) {
        return customerObj.name;
    } else if (customerObj.user && customerObj.user.name) {
        return customerObj.user.name;
    } else {
        return 'Tanpa Nama';
    }
}

/* ==========================================
   🌟 FUNGSI FALLBACK KUANTITAS / BERAT 🌟
   Jika API Laravel mengirimkan null/kosong/0
   maka kita akan otomatis hitung: Total / Harga Jasa
========================================== */
function fQty(trxItem) {
    // Langkah 1: Coba ambil nilai asli dari API Laravel 
    // (Laravel mungkin mengirimkan key: weight, qty, quantity, atau amount)
    let raw = null;
    
    if (trxItem) {
        if (trxItem.weight !== undefined && trxItem.weight !== null) raw = trxItem.weight;
        else if (trxItem.qty !== undefined && trxItem.qty !== null) raw = trxItem.qty;
        else if (trxItem.quantity !== undefined && trxItem.quantity !== null) raw = trxItem.quantity;
        else if (trxItem.amount !== undefined && trxItem.amount !== null) raw = trxItem.amount;
    }

    // Langkah 2: Logika Fallback Otomatis
    const totalPrice = parseFloat(trxItem?.total_price || 0);
    const servicePrice = parseFloat(trxItem?.service?.price || 0);

    // Kalau kosong, belum dikirim, atau dikirim "0" secara tidak sengaja oleh API, 
    // padahal ada harganya
    if (raw === null || raw === undefined || raw === '' || parseFloat(raw) === 0) {
        if (servicePrice > 0 && totalPrice > 0) {
            raw = totalPrice / servicePrice; 
        } else {
            return '-';
        }
    }

    const num = parseFloat(raw);
    
    if (isNaN(num)) {
        return '-';
    }

    // Langkah 3: Format angka yang cantik
    // Mengubah angka "2.500" menjadi "2.5" agar estetik
    let formattedNum = num;
    
    if (!Number.isInteger(num)) {
        formattedNum = num.toFixed(2).replace(/\.?0+$/, '');
    }

    // Ambil string satuan (Misal: Kg, Pcs)
    const unit = trxItem?.service?.unit || '';
    
    if (unit) {
        return formattedNum + ' ' + unit;
    } else {
        return formattedNum.toString();
    }
}

function toggleProof() {
    const methodSelect = document.getElementById('trx_pay');
    const proofBox = document.getElementById('proofBox');
    const proofInput = document.getElementById('trx_proof');
    
    const isTransfer = (methodSelect.value === 'transfer');
    
    proofInput.required = isTransfer;
    
    if (isTransfer) {
        proofBox.style.display = 'block';
    } else {
        proofBox.style.display = 'none';
    }
}

function updateQtyLabel() {
    const sel = document.getElementById('trx_srv');
    
    if (sel.selectedIndex < 0) return;
    
    const opt = sel.options[sel.selectedIndex];
    const unit = opt?.getAttribute('data-unit') || '';
    const lbl  = document.getElementById('lblQty');
    
    const unitLower = unit.toLowerCase();
    
    if (unitLower.includes('kg')) {
        lbl.textContent = 'Berat (Kg)';
    } else if (unitLower.includes('pcs')) {
        lbl.textContent = 'Jumlah (Pcs)';
    } else {
        lbl.textContent = 'Kuantitas';
    }
}

/* ==========================================
   PROGRESS TRACKER — REDESIGNED
========================================== */
function renderProgress(status) {
    const steps = [
        { key: 'antrian',      lbl: 'Antrian',   icon: 'ti-clock-hour-4' },
        { key: 'dicuci',       lbl: 'Dicuci',    icon: 'ti-wash' },
        { key: 'disetrika',    lbl: 'Setrika',   icon: 'ti-shirt' },
        { key: 'siap diambil', lbl: 'Siap',      icon: 'ti-package' },
        { key: 'diambil',      lbl: 'Selesai',   icon: 'ti-circle-check' }
    ];
    
    const idx = steps.findIndex(function(s) { return s.key === status; });
    
    const statusLabels = {
        'antrian':      'Pesanan masuk & menunggu antrian',
        'dicuci':       'Sedang dalam proses pencucian',
        'disetrika':    'Sedang disetrika & dirapikan',
        'siap diambil': 'Siap — bisa diambil sekarang!',
        'diambil':      'Pesanan telah selesai & diambil'
    };

    let htmlStr = '<div class="prog-track-wrap">';
    
    steps.forEach(function(s, i) {
        let st = i < idx ? 'done' : (i === idx ? 'active' : 'pending');
        const lineLeftDone  = (i > 0 && i <= idx);
        const lineRightDone = (i < idx);
        
        let circleContent = '';
        if (st === 'done') {
            circleContent = '<i class="ti ti-check prog-icon"></i>';
        } else if (st === 'active') {
            circleContent = `<i class="ti ${s.icon} prog-icon"></i>`;
        } else {
            circleContent = `<span style="font-size:10px;font-weight:700;">${i + 1}</span>`;
        }
        
        htmlStr += `
        <div class="prog-step">
            <div class="prog-step-row">
                ${i > 0 ? `<div class="prog-line${lineLeftDone ? ' done' : ''}"></div>` : ''}
                <div class="prog-circle ${st}">${circleContent}</div>
                ${i < steps.length - 1 ? `<div class="prog-line${lineRightDone ? ' done' : ''}"></div>` : ''}
            </div>
            <div class="prog-lbl ${st}">${s.lbl}</div>
        </div>`;
    });
    
    htmlStr += '</div>';
    
    // Status banner
    const bannerIcons = {
        'antrian':      'ti-clock-hour-4',
        'dicuci':       'ti-wash',
        'disetrika':    'ti-shirt',
        'siap diambil': 'ti-package',
        'diambil':      'ti-circle-check'
    };
    htmlStr += `
    <div class="prog-status-banner">
        <i class="ti ${bannerIcons[status] || 'ti-clock'}" style="font-size:15px;"></i>
        <span>${statusLabels[status] || status}</span>
    </div>`;
    
    document.getElementById('progTracker').innerHTML = htmlStr;
}

/* ==========================================
   CHART.JS RENDERER
========================================== */
function renderChart(data, type) {
    if (type) {
        chartType = type;
    }
    
    const cnt = { 
        'antrian': 0, 
        'dicuci': 0, 
        'disetrika': 0, 
        'siap diambil': 0, 
        'diambil': 0 
    };
    
    data.forEach(function(t) { 
        if (cnt[t.status] !== undefined) {
            cnt[t.status]++; 
        }
    });
    
    const labels = ['Antrian', 'Dicuci', 'Setrika', 'Siap', 'Selesai'];
    const vals   = [
        cnt['antrian'], 
        cnt['dicuci'], 
        cnt['disetrika'], 
        cnt['siap diambil'], 
        cnt['diambil']
    ];
    
    const colors = ['#A3A3A3', '#38BDF8', '#A78BFA', '#2DD4BF', '#4ADE80'];
    
    if (chartInst) {
        chartInst.destroy();
    }
    
    const ctx = document.getElementById('mainChart').getContext('2d');
    
    let chartBgColors = [];
    let chartBorderWidth = 2;
    let chartBorderRadius = 5;
    
    if (chartType === 'doughnut') {
        chartBgColors = colors;
        chartBorderWidth = 0;
        chartBorderRadius = 0;
    } else {
        chartBgColors = colors.map(function(c) { return c + '33'; });
    }
    
    chartInst = new Chart(ctx, {
        type: chartType === 'doughnut' ? 'doughnut' : 'bar',
        data: { 
            labels: labels, 
            datasets: [{ 
                label: 'Pesanan', 
                data: vals, 
                backgroundColor: chartBgColors, 
                borderColor: colors, 
                borderWidth: chartBorderWidth, 
                borderRadius: chartBorderRadius 
            }] 
        },
        options: {
            responsive: true, 
            maintainAspectRatio: false,
            plugins: { 
                legend: { 
                    display: (chartType === 'doughnut'), 
                    position: 'right', 
                    labels: { 
                        font: { size: 11 }, 
                        padding: 10 
                    } 
                } 
            },
            scales: chartType === 'doughnut' ? {} : { 
                y: { 
                    beginAtZero: true, 
                    ticks: { stepSize: 1, font: { size: 10 } }, 
                    grid: { color: '#F5F2EE' } 
                }, 
                x: { 
                    grid: { display: false }, 
                    ticks: { font: { size: 10 } } 
                } 
            }
        }
    });
}

function updateStats() {
    let paidArr = [];
    
    trxData.forEach(function(t) {
        if (t.payment_status === 'paid' || t.payment_status === 'lunas') {
            paidArr.push(t);
        }
    });
    
    let paidRev = 0;
    paidArr.forEach(function(t) {
        paidRev += parseFloat(t.total_price || 0);
    });
    
    const r = document.getElementById('rep-paid');
    if (r) {
        r.textContent = rp(paidRev);
    }
    
    let doneCount = 0;
    let pendingCount = 0;
    
    trxData.forEach(function(t) {
        if (t.status === 'diambil') {
            doneCount++;
        } else {
            pendingCount++;
        }
    });
    
    const d = document.getElementById('rep-done');  
    if (d) {
        d.textContent = doneCount;
    }
    
    const p = document.getElementById('rep-pending');
    if (p) {
        p.textContent = pendingCount;
    }
}

/* ==========================================
   API FETCHES
========================================== */
async function fetchDashStats() {
    try {
        const response = await fetch('/api/dashboard-stats', { headers: H });
        const resJson = await response.json();
        
        if (resJson.success) {
            document.getElementById('stat-revenue').textContent = rp(resJson.data.revenue);
            document.getElementById('stat-transactions').textContent = resJson.data.transactions || 0;
            document.getElementById('stat-customers').textContent = resJson.data.customers || 0;
        }
    } catch (error) {
        console.error('Error fetching dashboard stats:', error);
    }
}

async function fetchSrvs() {
    try {
        const response = await fetch('/api/services', { headers: H });
        const resJson = await response.json();
        
        srvData = resJson.data || [];
        
        const tb = document.getElementById('srvTBody');
        
        if (srvData.length === 0) { 
            tb.innerHTML = `
            <tr class="empty-row">
                <td colspan="4">Belum ada layanan.</td>
            </tr>`; 
            return; 
        }
        
        let htmlStr = '';
        srvData.forEach(function(s) {
            const sName = s.service_name || '-';
            const sPrice = rp(s.price);
            const sUnit = s.unit || '-';
            
            htmlStr += `
            <tr>
                <td>
                    <div style="font-weight:600;">${sName}</div>
                </td>
                <td>
                    <div style="font-weight:700;">${sPrice}</div>
                </td>
                <td>
                    <span style="font-size:10px;font-weight:700;color:var(--clr-muted);background:#F5F2EE;padding:3px 8px;border-radius:5px;text-transform:uppercase;">
                        ${sUnit}
                    </span>
                </td>
                <td>
                    <div class="tbl-actions">
                        <button onclick="editSrv(${s.id})" class="btn btn-edit btn-sm btn-icon">
                            <i class="ti ti-pencil" style="font-size:13px;"></i>
                        </button>
                        <button onclick="delSrv(${s.id})" class="btn btn-del btn-sm btn-icon">
                            <i class="ti ti-trash" style="font-size:13px;"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
        });
        
        tb.innerHTML = htmlStr;
        
    } catch (error) { 
        toast('error', 'Gagal memuat layanan'); 
        console.error('Fetch Service Error:', error);
    }
}

async function fetchCusts() {
    try {
        const searchInput = document.getElementById('srchCust').value;
        let url = '/api/customers';
        
        if (searchInput) {
            url += `?search=${encodeURIComponent(searchInput)}`;
        }
        
        const response = await fetch(url, { headers: H });
        const resJson = await response.json();
        
        custData = resJson.data || [];
        
        const tb = document.getElementById('custTBody');
        
        if (custData.length === 0) { 
            tb.innerHTML = `
            <tr class="empty-row">
                <td colspan="5">Tidak ada pelanggan.</td>
            </tr>`; 
            return; 
        }
        
        let htmlStr = '';
        
        custData.forEach(function(c) {
            const nm = cName(c);
            const em = c.user?.email || '-';
            
            let waLink = '#';
            if (c.phone) {
                waLink = `https://wa.me/${c.phone.replace(/\D/g, '')}`;
            }
            
            // 🌟 TRX PERBAIKAN: Hanya hitung yang berstatus Selesai (diambil) 🌟
            let trxCount = 0;
            trxData.forEach(function(t) {
                if (t.customer_id === c.id) {
                    if (t.status === 'diambil' || t.status === 'selesai') {
                        trxCount++;
                    }
                }
            });
            
            const addr = c.address || '-';
            
            htmlStr += `
            <tr>
                <td>
                    <div style="font-weight:600;">${nm}</div>
                    <div style="font-size:11px;color:var(--clr-muted);margin-top:2px;">${em}</div>
                </td>
                <td>
                    <a href="${waLink}" target="_blank" style="display:inline-flex;align-items:center;gap:5px;padding:3px 8px;background:#F0FDF4;color:#15803D;border-radius:6px;font-size:11px;font-weight:600;text-decoration:none;">
                        <i class="ti ti-brand-whatsapp" style="font-size:13px;"></i> ${c.phone || '-'}
                    </a>
                </td>
                <td style="font-size:12px;color:var(--clr-muted);max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    ${addr}
                </td>
                <td style="font-size:12px;font-weight:700;color:var(--clr-primary);">
                    ${trxCount} trx
                </td>
                <td>
                    <div class="tbl-actions">
                        <button onclick="editCust(${c.id})" class="btn btn-edit btn-sm btn-icon">
                            <i class="ti ti-pencil" style="font-size:13px;"></i>
                        </button>
                        <button onclick="delCust(${c.id})" class="btn btn-del btn-sm btn-icon">
                            <i class="ti ti-trash" style="font-size:13px;"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
        });
        
        tb.innerHTML = htmlStr;
        
    } catch (error) { 
        toast('error', 'Gagal memuat pelanggan'); 
        console.error('Fetch Customer Error:', error);
    }
}

async function fetchTrx() {
    try {
        const sf = document.getElementById('filterStatus').value;
        const df = document.getElementById('filterDate').value;
        
        let url = '/api/transactions';
        const params = new URLSearchParams();
        
        if (sf) params.append('status', sf);
        if (df) params.append('date', df);
        
        if (params.toString()) {
            url += '?' + params.toString();
        }
        
        const response = await fetch(url, { headers: H });
        const resJson = await response.json();
        
        trxData = resJson.data || [];
        
        renderChart(trxData);
        
        let pendingCount = 0;
        trxData.forEach(function(t) {
            if (t.status !== 'diambil') {
                pendingCount++;
            }
        });
        
        document.getElementById('stat-active').textContent = pendingCount;
        
        updateStats();
        
        // Antrian dot
        let hasAntrian = false;
        trxData.forEach(function(t) {
            if (t.status === 'antrian') {
                hasAntrian = true;
            }
        });
        
        if (hasAntrian) {
            document.getElementById('transaksiDot').style.display = 'block';
        } else {
            document.getElementById('transaksiDot').style.display = 'none';
        }
        
        // Popular services logic
        const srvCountObj = {};
        trxData.forEach(function(t) {
            const n = t.service?.service_name || 'Dihapus'; 
            if (!srvCountObj[n]) {
                srvCountObj[n] = 0;
            }
            srvCountObj[n] += 1; 
        });
        
        // Sorting
        const sortedEntries = Object.entries(srvCountObj).sort(function(a, b) {
            return b[1] - a[1];
        }).slice(0, 5);
        
        const pList = document.getElementById('popularList');
        const barClr = ['var(--clr-primary)', '#38BDF8', '#A78BFA', '#4ADE80', '#F59E0B'];
        
        if (pList) {
            if (sortedEntries.length > 0) {
                let popHtml = '';
                sortedEntries.forEach(function(itemArr, i) {
                    const svcName = itemArr[0];
                    const svcCount = itemArr[1];
                    popHtml += `
                    <div style="display:flex;align-items:center;gap:9px;">
                        <div style="width:7px;height:7px;border-radius:50%;background:${barClr[i]};flex-shrink:0;"></div>
                        <span style="flex:1;font-size:12px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${svcName}</span>
                        <span style="font-size:11px;font-weight:700;color:var(--clr-muted);">${svcCount} trx</span>
                    </div>`;
                });
                pList.innerHTML = popHtml;
            } else {
                pList.innerHTML = '<p style="font-size:12px;color:var(--clr-muted);">Belum ada data.</p>';
            }
        }
        
        renderTrxTable(trxData);
        renderRecentTable(trxData);
        
        // Memanggil fetchCusts jika pengguna mereload trx, supaya data count sinkron
        if (document.getElementById('view-pelanggan').style.display !== 'none') {
            fetchCusts();
        }
        
    } catch (error) { 
        toast('error', 'Gagal memuat transaksi'); 
        console.error('Fetch Transaction Error:', error);
    }
}

function renderTrxTable(data) {
    const tb = document.getElementById('trxTBody');
    
    if (data.length === 0) { 
        tb.innerHTML = `
        <tr class="empty-row">
            <td colspan="6">Belum ada pesanan.</td>
        </tr>`; 
        return; 
    }
    
    let htmlStr = '';
    
    data.forEach(function(item) {
        const inv = item.invoice_code || '-';
        const date = fDT(item.created_at);
        const custName = cName(item.customer);
        const svcName = item.service?.service_name || '-';
        const qty = fQty(item);
        const total = rp(item.total_price);
        const method = item.payment_method || '-';
        const statusBadge = badge(item.status);
        
        htmlStr += `
        <tr class="clickable" onclick="viewDetail(${item.id})">
            <td>
                <div style="font-weight:600;font-size:12px;">${inv}</div>
                <div style="font-size:11px;color:var(--clr-muted);margin-top:1px;">${date}</div>
            </td>
            <td style="font-weight:500;">
                ${custName}
            </td>
            <td>
                <div style="font-size:12px;font-weight:600;">${svcName}</div>
                <div style="font-size:11px;color:var(--clr-muted);">${qty}</div>
            </td>
            <td>
                <div style="font-weight:700;">${total}</div>
            </td>
            <td>
                <span style="font-size:10px;font-weight:600;text-transform:uppercase;color:var(--clr-muted);">
                    ${method}
                </span>
            </td>
            <td style="text-align:center;">
                ${statusBadge}
            </td>
        </tr>`;
    });
    
    tb.innerHTML = htmlStr;
}

function renderRecentTable(data) {
    const tb = document.getElementById('recentTBody');
    
    if (data.length === 0) { 
        tb.innerHTML = `
        <tr class="empty-row">
            <td colspan="5">Belum ada data.</td>
        </tr>`; 
        return; 
    }
    
    let htmlStr = '';
    
    const sliceData = data.slice(0, 5);
    
    sliceData.forEach(function(item) {
        const custName = cName(item.customer);
        const inv = item.invoice_code || '-';
        const svcName = item.service?.service_name || '-';
        const total = rp(item.total_price);
        const statusBadge = badge(item.status);
        
        htmlStr += `
        <tr class="clickable" onclick="switchTab('transaksi');setTimeout(()=>viewDetail(${item.id}),100);">
            <td style="font-weight:600;">${custName}</td>
            <td style="font-size:12px;color:var(--clr-muted);">${inv}</td>
            <td style="font-size:12px;">${svcName}</td>
            <td style="font-weight:700;">${total}</td>
            <td style="text-align:center;">${statusBadge}</td>
        </tr>`;
    });
    
    tb.innerHTML = htmlStr;
}

function filterTrxLocal() {
    const inputElement = document.getElementById('srchTrx');
    const q = inputElement.value.toLowerCase();
    
    if (!q) { 
        renderTrxTable(trxData); 
        return; 
    }
    
    let filteredArr = [];
    
    trxData.forEach(function(t) {
        const cNameLower = cName(t.customer).toLowerCase();
        const invLower = (t.invoice_code || '').toLowerCase();
        
        if (cNameLower.includes(q) || invLower.includes(q)) {
            filteredArr.push(t);
        }
    });
    
    renderTrxTable(filteredArr);
}

function exportCSV() {
    if (trxData.length === 0) { 
        toast('warning', 'Tidak ada data'); 
        return; 
    }
    
    let csv = 'Invoice,Tanggal,Pelanggan,Layanan,Kuantitas,Total,Metode,Status\n';
    
    trxData.forEach(function(t) { 
        const inv = t.invoice_code || '-';
        const date = fDate(t.created_at);
        const cust = cName(t.customer);
        const srv = t.service?.service_name || '-';
        const qty = fQty(t);
        const tot = t.total_price || 0;
        const meth = t.payment_method || '-';
        const stat = t.status || '-';
        
        csv += `${inv},${date},${cust},${srv},${qty},${tot},${meth},${stat}\n`; 
    });
    
    const a = document.createElement('a');
    a.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
    
    const dateStr = new Date().toLocaleDateString('id-ID');
    a.download = `Laundrea_Export_${dateStr}.csv`;
    
    document.body.appendChild(a); 
    a.click(); 
    document.body.removeChild(a);
    
    toast('success', 'CSV berhasil diunduh');
}

/* ==========================================
   DETAIL TRANSAKSI & CETAK STRUK
========================================== */
window.viewDetail = function(id) {
    let t = null;
    
    trxData.forEach(function(item) {
        if (item.id === id) {
            t = item;
        }
    });
    
    if (!t) return;

    document.getElementById('detBadge').innerHTML = badge(t.status);
    document.getElementById('det_trx_id').value = t.id;
    document.getElementById('det_status').value = t.status;
    // Reset foto upload zone dengan bersih
    resetPhotoUpload();
    
    renderProgress(t.status);

    /* ── STRUK THERMAL DATA BINDING ── */
    const nm  = cName(t.customer);
    const srv = t.service?.service_name || 'Layanan';
    const unt = t.service?.unit || '';
    const prc = t.service?.price || 0;
    const tot = t.total_price || 0;
    const qty = fQty(t);
    const d   = new Date(t.created_at);
    
    const dateFormatted = d.toLocaleDateString('id-ID') + ' ' + d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    
    document.getElementById('r_date').textContent  = dateFormatted;
    document.getElementById('r_inv').textContent   = t.invoice_code || '-';
    document.getElementById('r_cust').textContent  = nm;
    document.getElementById('r_srv').textContent   = srv.toUpperCase();
    
    // Perbaikan Baris Harga (Kuantitas x Harga Satuan)
    document.getElementById('r_qty').textContent   = `${qty} x ${rp(prc)}`;
    document.getElementById('r_price').textContent = rp(tot);
    
    document.getElementById('r_total').textContent = rp(tot);
    document.getElementById('r_pay').textContent   = t.payment_method || '-';
    document.getElementById('r_paystatus').textContent = t.payment_status || 'LUNAS';

    // Opsional: Coba tampilkan raw response JSON di Debug panel jika ada
    try { 
        const debugElement = document.getElementById('debugJSON');
        if (debugElement) {
            debugElement.textContent = JSON.stringify(t, null, 2); 
        }
    } catch(err) {
        console.error('Debug UI error', err);
    }

    /* ── 🌟 FITUR MUNCULKAN GALERI FOTO UPDATE STATUS 🌟 ── */
    // Menambahkan timestamp ke src gambar supaya gambar selalu ter-refresh tanpa cache
    const cacheBuster = new Date().getTime();
    
    function buildImgSrc(rawPath) {
        if (!rawPath) return null;
        
        let pathString = String(rawPath).trim();
        
        if (pathString.startsWith('http://') || pathString.startsWith('https://')) {
            return pathString + "?v=" + cacheBuster;
        }
        
        // Membersihkan awalan folder agar seragam
        pathString = pathString.replace(/^\/+/, '').replace(/^storage\//, '');
        return '/storage/' + pathString + "?v=" + cacheBuster;
    }

    // List key foto yang bisa direspon oleh backend. 
    // Kita tambahkan banyak fallback key untuk memastikan fotonya tertangkap!
    const slots = [
        { key: 'payment_proof',   lbl: 'Bukti Transfer',  icon: 'ti-transfer-in' },
        { key: 'clothes_photo',   lbl: 'Kondisi Masuk',   icon: 'ti-shirt' },
        { key: 'photo_dicuci',    lbl: 'Saat Dicuci',     icon: 'ti-wash' },
        { key: 'photo_disetrika', lbl: 'Saat Disetrika',  icon: 'ti-iron' },
        { key: 'photo_siap',      lbl: 'Siap Diambil',    icon: 'ti-package' },
        { key: 'photo_diambil',   lbl: 'Telah Selesai',   icon: 'ti-circle-check' },
        { key: 'photo',           lbl: 'Update Terakhir', icon: 'ti-photo' }
    ];

    const gal = document.getElementById('galTracking');
    let photosHTML = '';
    let hasPhoto = false;

    // Track which keys we already showed so we don't duplicate fallback
    let showedUrls = [];

    slots.forEach(function(slot) {
        const imgSrc = buildImgSrc(t[slot.key]);
        
        if (!imgSrc) return;
        
        // Cegah duplikat gambar (misal photo dan photo_diambil URL nya sama)
        const baseUrl = imgSrc.split('?v=')[0];
        if (showedUrls.includes(baseUrl)) return;
        
        showedUrls.push(baseUrl);
        hasPhoto = true;
        
        photosHTML += `
        <div class="gal-item">
            <div class="gal-lbl"><i class="ti ${slot.icon}" style="font-size:10px;"></i>${slot.lbl}</div>
            <a href="${imgSrc}" target="_blank">
                <img src="${imgSrc}" alt="${slot.lbl}" loading="lazy"
                     onerror="this.closest('a').outerHTML='<div style=&quot;height:85px;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:4px;background:#FAFAF8;font-size:10px;color:var(--clr-muted);&quot;><i class=&quot;ti ti-photo-off&quot; style=&quot;font-size:20px;&quot;></i><span>Gagal dimuat</span></div>'">
            </a>
        </div>`;
    });

    if (hasPhoto) {
        gal.innerHTML = '<div class="gal-grid">' + photosHTML + '</div>';
    } else {
        gal.innerHTML = `
        <div class="gal-empty">
            <i class="ti ti-photo-off" style="font-size:24px;display:block;margin-bottom:6px;"></i>
            Belum ada foto progress
        </div>`;
    }

    openModal('detailModal');
};

// Fitur klik ganda judul galeri untuk menampilkan JSON (Debug Tool)
document.addEventListener('dblclick', function(e) {
    const targetElement = e.target;
    const closestGalTracking = targetElement.closest('#galTracking');
    
    if (closestGalTracking) {
        const prevElement = closestGalTracking.previousElementSibling;
        if (prevElement && prevElement.textContent && prevElement.textContent.includes('Galeri')) {
            const dp = document.getElementById('debugPanel');
            if (dp) {
                if (dp.style.display === 'none') {
                    dp.style.display = 'block';
                } else {
                    dp.style.display = 'none';
                }
            }
        }
    }
});

/* ==========================================
   SERVICE MODAL
========================================== */
function openSrvModal() {
    document.getElementById('srvForm').reset();
    document.getElementById('srv_id').value = '';
    document.getElementById('srvModalTitle').textContent = 'Tambah Layanan';
    openModal('srvModal');
}

window.editSrv = function(id) {
    let s = null;
    
    srvData.forEach(function(x) {
        if (x.id === id) {
            s = x;
        }
    });
    
    if (!s) return;
    
    document.getElementById('srv_id').value = s.id;
    document.getElementById('srv_name').value = s.service_name || '';
    
    const sUnit = (s.unit || '').toLowerCase();
    let srvType = 'satuan';
    if (sUnit.includes('kg')) {
        srvType = 'kiloan';
    }
    document.getElementById('srv_type').value = srvType;
    
    document.getElementById('srv_price').value = s.price || 0;
    document.getElementById('srvModalTitle').textContent = 'Edit Layanan';
    
    openModal('srvModal');
};

/* ==========================================
   CUSTOMER MODAL
========================================== */
function openCustModal() {
    document.getElementById('custForm').reset();
    document.getElementById('cust_id').value = '';
    document.getElementById('custModalTitle').textContent = 'Registrasi Pelanggan';
    
    document.getElementById('authFields').style.display = 'block';
    document.getElementById('cust_email').required = true;
    document.getElementById('cust_pass').required = true;
    
    openModal('custModal');
}

window.editCust = function(id) {
    let c = null;
    
    custData.forEach(function(x) {
        if (x.id === id) {
            c = x;
        }
    });
    
    if (!c) return;
    
    document.getElementById('cust_id').value  = c.id;
    document.getElementById('cust_name').value = cName(c);
    document.getElementById('cust_phone').value = c.phone || '';
    document.getElementById('cust_addr').value  = c.address || '';
    document.getElementById('custModalTitle').textContent = 'Edit Pelanggan';
    
    document.getElementById('authFields').style.display = 'none';
    document.getElementById('cust_email').required = false;
    document.getElementById('cust_pass').required  = false;
    
    openModal('custModal');
};

/* ==========================================
   TRX MODAL (TAMBAH TRANSAKSI BARU)
========================================== */
function openTrxModal() {
    document.getElementById('trxForm').reset();
    
    let custOptions = '<option value="">-- Pilih Pelanggan --</option>';
    custData.forEach(function(c) {
        const namaText = cName(c);
        const hpText = c.phone || '-';
        custOptions += `<option value="${c.id}">${namaText} (${hpText})</option>`;
    });
    document.getElementById('trx_cust').innerHTML = custOptions;
        
    let srvOptions = '<option value="" data-unit="">-- Pilih Layanan --</option>';
    srvData.forEach(function(s) {
        const hargaText = rp(s.price);
        const unitText = s.unit || '-';
        srvOptions += `<option value="${s.id}" data-unit="${s.unit || ''}">${s.service_name} — ${hargaText}/${unitText}</option>`;
    });
    document.getElementById('trx_srv').innerHTML = srvOptions;
        
    document.getElementById('lblQty').textContent = 'Kuantitas';
    document.getElementById('proofBox').style.display = 'none';
    
    openModal('trxModal');
}

/* ==========================================
   FORM SUBMITS (AKSI PENYIMPANAN DATA)
========================================== */

// ── FORM: SIMPAN LAYANAN ──
document.getElementById('srvForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btnSaveSrv');
    btn.textContent = 'Menyimpan...'; 
    btn.disabled = true;
    
    const id = document.getElementById('srv_id').value;
    const nm = document.getElementById('srv_name').value;
    const sType = document.getElementById('srv_type').value;
    const sPrice = document.getElementById('srv_price').value;
    
    let unit = 'Pcs';
    if (sType === 'kiloan') {
        unit = 'Kg';
    }
    
    let url = '/api/services';
    let methodType = 'POST';
    
    if (id) {
        url = `/api/services/${id}`;
        methodType = 'PUT';
    }
    
    const payload = { 
        service_name: nm, 
        price: sPrice, 
        unit: unit 
    };
    
    try {
        const response = await fetch(url, {
            method: methodType, 
            headers: H,
            body: JSON.stringify(payload)
        });
        
        const resJson = await response.json();
        
        if (resJson.success || resJson.data) {
            closeModal('srvModal'); 
            fetchSrvs();
            
            if (id) {
                toast('success', 'Layanan diperbarui');
                addActivity('service', `Memperbarui layanan: ${nm}`);
            } else {
                toast('success', 'Layanan ditambahkan');
                addActivity('service', `Menambah layanan: ${nm}`);
            }
            
        } else {
            throw new Error(resJson.message || 'Operasi layanan gagal');
        }
        
    } catch(err) { 
        toast('error', 'Gagal menyimpan layanan', err.message); 
        console.error('Service save err:', err);
    } finally { 
        btn.textContent = 'Simpan'; 
        btn.disabled = false; 
    }
});

// ── FORM: SIMPAN PELANGGAN ──
document.getElementById('custForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btnSaveCust');
    btn.textContent = 'Menyimpan...'; 
    btn.disabled = true;
    
    const id = document.getElementById('cust_id').value;
    const nm = document.getElementById('cust_name').value;
    const ph = document.getElementById('cust_phone').value;
    const ad = document.getElementById('cust_addr').value;
    
    let payload = { 
        name: nm, 
        phone: ph, 
        address: ad 
    };
    
    if (!id) { 
        payload.email = document.getElementById('cust_email').value; 
        payload.password = document.getElementById('cust_pass').value; 
    }
    
    let url = '/api/customers';
    let methodType = 'POST';
    
    if (id) {
        url = `/api/customers/${id}`;
        methodType = 'PUT';
    }
    
    try {
        const response = await fetch(url, {
            method: methodType, 
            headers: H, 
            body: JSON.stringify(payload)
        });
        
        const resJson = await response.json();
        
        if (resJson.success || resJson.data) {
            closeModal('custModal'); 
            fetchCusts(); 
            fetchDashStats();
            
            if (id) {
                toast('success', 'Pelanggan berhasil diperbarui');
                addActivity('customer', `Update pelanggan: ${nm}`);
            } else {
                toast('success', 'Pelanggan baru terdaftar');
                addActivity('customer', `Daftarkan pelanggan: ${nm}`);
            }
            
        } else {
            throw new Error(resJson.message || 'Gagal menyimpan pelanggan');
        }
        
    } catch(err) { 
        toast('error', 'Gagal simpan', err.message); 
        console.error('Customer save err:', err);
    } finally { 
        btn.textContent = 'Simpan'; 
        btn.disabled = false; 
    }
});

// ── FORM: SIMPAN TRANSAKSI BARU ──
document.getElementById('trxForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btnSaveTrx');
    btn.innerHTML = '<i class="ti ti-loader" style="font-size:12px;animation:spin 1s linear infinite;"></i> Memproses...';
    btn.disabled = true;
    
    const cId = document.getElementById('trx_cust').value;
    const sId = document.getElementById('trx_srv').value;
    const qty = document.getElementById('trx_qty').value;
    const pMt = document.getElementById('trx_pay').value;
    
    const fd = new FormData();
    fd.append('customer_id', cId);
    fd.append('service_id',  sId);
    fd.append('weight',      qty);
    
    // Fallback append agar aman untuk versi Laravel yang berbeda
    fd.append('qty',         qty);
    fd.append('quantity',    qty);
    
    fd.append('payment_method', pMt);
    
    const cp = document.getElementById('trx_photo').files[0]; 
    if (cp) {
        fd.append('clothes_photo', cp);
    }
    
    if (pMt === 'transfer') {
        const pr = document.getElementById('trx_proof').files[0]; 
        if (pr) {
            fd.append('payment_proof', pr);
        }
    }
    
    const selEl = document.getElementById('trx_cust');
    let custLbl = '';
    
    if (selEl.selectedIndex >= 0) {
        custLbl = selEl.options[selEl.selectedIndex].text;
    }
    
    try {
        const response = await fetch('/api/transactions', { 
            method: 'POST', 
            headers: HF, 
            body: fd 
        });
        
        const resJson = await response.json();
        
        if (resJson.success || resJson.data) {
            closeModal('trxModal'); 
            fetchTrx(); 
            fetchDashStats();
            
            const inv = resJson.data?.invoice_code || '';
            toast('success', 'Nota berhasil dibuat', inv);
            
            let actString = 'Pesanan baru: ';
            if (inv) actString += inv; else actString += 'Nota';
            actString += ' — ' + custLbl;
            
            addActivity('order', actString);
            
        } else {
            throw new Error(resJson.message || 'Gagal menyimpan transaksi');
        }
        
    } catch(err) { 
        toast('error', 'Gagal buat nota', err.message); 
        console.error('Trx save err:', err);
    } finally { 
        btn.innerHTML = '<i class="ti ti-device-floppy" style="font-size:12px;"></i> Simpan Order'; 
        btn.disabled = false; 
    }
});

/* ==========================================
   PHOTO UPLOAD PREVIEW HANDLER
========================================== */
function handlePhotoPreview(input) {
    const zone     = document.getElementById('photoUploadZone');
    const content  = document.getElementById('photoUploadContent');
    const resetRow = document.getElementById('photoResetRow');
    
    if (!input.files || !input.files[0]) return;
    
    const file = input.files[0];
    
    // Validasi ukuran: maks 5MB
    if (file.size > 5 * 1024 * 1024) {
        toast('warning', 'Foto terlalu besar', 'Maks ukuran file 5MB');
        input.value = '';
        return;
    }
    
    const reader = new FileReader();
    
    reader.onload = function(e) {
        zone.classList.add('has-file');
        content.innerHTML = `
            <img src="${e.target.result}" class="photo-preview-thumb" alt="Preview">
            <div class="photo-file-name">
                <i class="ti ti-photo-check" style="font-size:11px;vertical-align:-1px;"></i>
                ${file.name}
            </div>`;
        resetRow.style.display = 'block';
    };
    
    reader.readAsDataURL(file);
}

function resetPhotoUpload() {
    const input    = document.getElementById('det_photo');
    const zone     = document.getElementById('photoUploadZone');
    const content  = document.getElementById('photoUploadContent');
    const resetRow = document.getElementById('photoResetRow');
    
    input.value = '';
    zone.classList.remove('has-file');
    content.innerHTML = `
        <div class="photo-upload-hint">
            <i class="ti ti-photo-up"></i>
            <span>Klik untuk pilih foto</span><br>
            <span style="font-size:10px;opacity:.7;">JPG, PNG — Maks 5MB</span>
        </div>`;
    resetRow.style.display = 'none';
}

// ── FORM: 🌟 UPDATE STATUS PROGRESS 🌟 ──
document.getElementById('statusForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btnUpdateStatus');
    const oldH = btn.innerHTML;
    
    btn.innerHTML = '<i class="ti ti-loader" style="font-size:12px;animation:spin 1s linear infinite;"></i> Menyimpan...';
    btn.disabled = true;
    
    const id = document.getElementById('det_trx_id').value;
    const newStatus = document.getElementById('det_status').value;
    const photoInput = document.getElementById('det_photo');
    const photo = photoInput.files[0];
    
    const fd = new FormData();
    fd.append('_method', 'PATCH');
    fd.append('status', newStatus);
    
    // Perbaikan Logika Upload Foto: 
    // Menyertakan key generic "photo" DAN key spesifik agar lebih aman
    if (photo) {
        fd.append('photo', photo);
        
        if (newStatus === 'dicuci') {
            fd.append('photo_dicuci', photo);
        } else if (newStatus === 'disetrika') {
            fd.append('photo_disetrika', photo);
        } else if (newStatus === 'siap diambil') {
            fd.append('photo_siap', photo);
        } else if (newStatus === 'diambil') {
            fd.append('photo_diambil', photo);
        }
    }
    
    try {
        const response = await fetch(`/api/transactions/${id}/status`, { 
            method: 'POST', 
            headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' },
            body: fd 
        });
        
        // Cek HTTP status dulu sebelum parse JSON
        if (!response.ok) {
            let errMsg = `Server error ${response.status}`;
            try { const ej = await response.json(); errMsg = ej.message || errMsg; } catch(_) {}
            throw new Error(errMsg);
        }
        
        const resJson = await response.json();
        
        if (resJson.success || resJson.data) {
            toast('success', 'Status diperbarui', `→ ${newStatus}`);
            
            let actMsg = `Status pesanan #${id} → "${newStatus}"`;
            if (photo) actMsg += ' (+ foto)';
            addActivity('update', actMsg);
            
            // Reset foto upload zone
            resetPhotoUpload();
            
            // Reload detail tanpa menutup modal agar foto langsung terlihat
            fetchTrx().then(function() {
                viewDetail(parseInt(id));
            });
            
        } else {
            throw new Error(resJson.message || 'Gagal mengubah status');
        }
        
    } catch(err) { 
        toast('error', 'Gagal update status', err.message); 
        console.error('Update status err:', err);
    } finally { 
        btn.innerHTML = oldH; 
        btn.disabled = false; 
    }
});

/* ==========================================
   DELETE FUNCTIONS
========================================== */
window.delSrv = function(id) {
    let nm = 'layanan ini';
    
    srvData.forEach(function(s) {
        if (s.id === id) {
            nm = s.service_name || nm;
        }
    });
    
    Swal.fire({ 
        title: 'Hapus Layanan?', 
        text: `"${nm}" akan dihapus permanen dari sistem.`, 
        icon: 'warning', 
        showCancelButton: true, 
        confirmButtonColor: '#DC2626', 
        cancelButtonText: 'Batal', 
        confirmButtonText: 'Ya, Hapus' 
    }).then(async function(r) {
        if (r.isConfirmed) {
            try {
                await fetch(`/api/services/${id}`, { method: 'DELETE', headers: H });
                fetchSrvs(); 
                toast('success', 'Layanan berhasil dihapus');
                addActivity('delete', `Hapus layanan: ${nm}`);
            } catch(e) {
                toast('error', 'Gagal menghapus layanan');
            }
        }
    });
};

window.delCust = function(id) {
    let c = null;
    
    custData.forEach(function(x) {
        if (x.id === id) c = x;
    });
    
    const nm = cName(c);
    
    Swal.fire({ 
        title: 'Hapus Pelanggan?', 
        text: `Pelanggan "${nm}" beserta akses loginnya akan dihapus.`, 
        icon: 'warning', 
        showCancelButton: true, 
        confirmButtonColor: '#DC2626', 
        cancelButtonText: 'Batal', 
        confirmButtonText: 'Ya, Hapus' 
    }).then(async function(r) {
        if (r.isConfirmed) {
            try {
                await fetch(`/api/customers/${id}`, { method: 'DELETE', headers: H });
                fetchCusts(); 
                fetchDashStats();
                toast('success', 'Pelanggan berhasil dihapus');
                addActivity('delete', `Hapus pelanggan: ${nm}`);
            } catch (e) {
                toast('error', 'Gagal menghapus pelanggan');
            }
        }
    });
};

/* ==========================================
   LOGOUT & REFRESH UTILITIES
========================================== */
async function logout() {
    try { 
        await fetch('/api/logout', { method: 'POST', headers: H }); 
    } catch(err) {
        console.error('Logout request failed', err);
    }
    
    localStorage.clear(); 
    window.location.href = '/login';
}

function doRefresh() {
    fetchDashStats(); 
    fetchTrx(); 
    fetchCusts();
    toast('info', 'Semua data terbaru berhasil dimuat');
}

/* ==========================================
   APP INITIALIZATION
========================================== */
renderNotifPanel();
updateBadge();
fetchDashStats();
fetchSrvs();
fetchCusts();
fetchTrx();

</script>
</body>
</html>