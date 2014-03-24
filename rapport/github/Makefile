NULL=

TEX_FILES= \
	document.tex \
	$(NULL)

TEX_INCLUDES= \
	gestion-de-version.tex \
	git.tex \
	github.tex \
	github-logo.png \
	github-logo.pdf \
	sourceforge-logo.png \
	gitlab-logo.png \
	centralized_example.png \
	distributed_example.png \
	$(NULL)

PDF_FILES=$(TEX_FILES:%.tex=%.pdf)

all: $(PDF_FILES)

$(PDF_FILES): %.pdf: %.tex
	pdflatex $<
	pdflatex $<

$(TEX_FILES): $(TEX_INCLUDES)
	@touch $*.tex

clean:
	rm -f *.out *.nav *.toc *.aux *.log *.snm *.vrb *.dvi *.ps

.PHONY: all clean

